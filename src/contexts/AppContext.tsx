import { createContext, useContext, useState, ReactNode, useEffect } from "react";
import { api } from "@/lib/api";
import { toast } from "sonner";

interface User {
  id: string;
  name: string;
  cpf: string;
  phone?: string;
  role: "student" | "admin";
  active: boolean;
  must_change_password?: boolean;
}

interface ExamResult {
  totalQuestions: number;
  correctAnswers: number;
  passed: boolean;
  completedAt: Date;
}

interface LoginResponse {
  success: boolean;
  mustChangePassword?: boolean;
  message?: string;
}

interface AppContextType {
  user: User | null;
  isAuthenticated: boolean;
  login: (cpf: string, password: string, role: "student" | "admin") => Promise<LoginResponse>;
  logout: () => void;
  examResult: ExamResult | null;
  setExamResult: (result: ExamResult | null) => void;
  students: User[];
  addStudent: (student: any) => Promise<void>;
  toggleStudentStatus: (id: string) => Promise<void>;
  isLoading: boolean;
}

const AppContext = createContext<AppContextType | undefined>(undefined);

export function AppProvider({ children }: { children: ReactNode }) {
  const [user, setUser] = useState<User | null>(null);
  const [examResult, setExamResult] = useState<ExamResult | null>(null);
  const [students, setStudents] = useState<User[]>([]);
  const [isLoading, setIsLoading] = useState(true);

  // Initialize from token
  useEffect(() => {
    const init = async () => {
      const token = localStorage.getItem("auth_token");
      if (token) {
        try {
          const userData = await api.get("/auth/me");
          setUser(userData);
          if (userData.role === "admin") {
            const studentsData = await api.get("/students");
            setStudents(studentsData);
          }
        } catch (error) {
          console.error("Session expired", error);
          localStorage.removeItem("auth_token");
          setUser(null);
        }
      }
      setIsLoading(false);
    };
    init();
  }, []);

  const login = async (cpf: string, password: string, role: "student" | "admin"): Promise<LoginResponse> => {
    try {
      const endpoint = role === "admin" ? "/auth/login/admin" : "/auth/login/student";
      const data = await api.post(endpoint, { cpf, password });

      setUser(data.user);
      localStorage.setItem("auth_token", data.token);

      if (data.user.role === "admin") {
        const studentsData = await api.get("/students");
        setStudents(studentsData);
      }

      return {
        success: true,
        mustChangePassword: data.must_change_password
      };
    } catch (error: any) {
      toast.error(error.message || "Falha no login");
      return { success: false, message: error.message };
    }
  };

  const logout = () => {
    api.post("/auth/logout", {}).catch(console.error);
    setUser(null);
    setStudents([]);
    localStorage.removeItem("auth_token");
    setExamResult(null);
  };

  const addStudent = async (studentData: any) => {
    try {
      const newStudent = await api.post("/students", studentData);
      setStudents((prev) => [newStudent, ...prev]);
      toast.success("Aluno adicionado com sucesso!");
    } catch (error: any) {
      toast.error(error.message || "Erro ao adicionar aluno");
    }
  };

  const toggleStudentStatus = async (id: string) => {
    try {
      const updatedStudent = await api.patch(`/students/${id}/toggle-status`);
      setStudents((prev) =>
        prev.map((s) => (s.id.toString() === id.toString() ? updatedStudent : s))
      );
      toast.success(updatedStudent.active ? "Aluno ativado!" : "Aluno desativado!");
    } catch (error: any) {
      toast.error(error.message || "Erro ao alterar status");
    }
  };

  return (
    <AppContext.Provider
      value={{
        user,
        isAuthenticated: user !== null,
        login,
        logout,
        examResult,
        setExamResult,
        students,
        addStudent,
        toggleStudentStatus,
        isLoading,
      }}
    >
      {children}
    </AppContext.Provider>
  );
}

export function useApp() {
  const context = useContext(AppContext);
  if (context === undefined) {
    throw new Error("useApp must be used within an AppProvider");
  }
  return context;
}

