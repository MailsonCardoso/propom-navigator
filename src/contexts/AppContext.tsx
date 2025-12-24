import { createContext, useContext, useState, ReactNode } from "react";

interface User {
  id: string;
  name: string;
  login: string;
  role: "student" | "admin";
  active: boolean;
}

interface ExamResult {
  totalQuestions: number;
  correctAnswers: number;
  passed: boolean;
  completedAt: Date;
}

interface AppContextType {
  user: User | null;
  isAuthenticated: boolean;
  login: (login: string, password: string, role: "student" | "admin") => boolean;
  logout: () => void;
  examResult: ExamResult | null;
  setExamResult: (result: ExamResult | null) => void;
  students: User[];
  addStudent: (student: Omit<User, "id">) => void;
  toggleStudentStatus: (id: string) => void;
}

const AppContext = createContext<AppContextType | undefined>(undefined);

const mockStudents: User[] = [
  { id: "1", name: "João Silva", login: "joao.silva", role: "student", active: true },
  { id: "2", name: "Maria Santos", login: "maria.santos", role: "student", active: true },
  { id: "3", name: "Pedro Oliveira", login: "pedro.oliveira", role: "student", active: false },
  { id: "4", name: "Ana Costa", login: "ana.costa", role: "student", active: true },
  { id: "5", name: "Carlos Ferreira", login: "carlos.ferreira", role: "student", active: true },
];

export function AppProvider({ children }: { children: ReactNode }) {
  const [user, setUser] = useState<User | null>(null);
  const [examResult, setExamResult] = useState<ExamResult | null>(null);
  const [students, setStudents] = useState<User[]>(mockStudents);

  const login = (loginInput: string, password: string, role: "student" | "admin"): boolean => {
    // Simulated login - always succeeds
    if (role === "admin") {
      setUser({
        id: "admin-1",
        name: "Administrador",
        login: loginInput,
        role: "admin",
        active: true,
      });
    } else {
      setUser({
        id: "student-1",
        name: "Aluno Teste",
        login: loginInput,
        role: "student",
        active: true,
      });
    }
    return true;
  };

  const logout = () => {
    setUser(null);
    setExamResult(null);
  };

  const addStudent = (student: Omit<User, "id">) => {
    const newStudent: User = {
      ...student,
      id: `student-${Date.now()}`,
    };
    setStudents((prev) => [...prev, newStudent]);
  };

  const toggleStudentStatus = (id: string) => {
    setStudents((prev) =>
      prev.map((s) => (s.id === id ? { ...s, active: !s.active } : s))
    );
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
