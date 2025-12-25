// Configuração da API para o Frontend React
// Adicione este arquivo em: src/config/api.ts

const API_CONFIG = {
    // URL base da API
    baseURL: 'http://localhost:8000/api',

    // Timeout padrão (30 segundos)
    timeout: 30000,

    // Headers padrão
    headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
    },
};

// Função helper para adicionar o token de autenticação
export const getAuthHeader = () => {
    const token = localStorage.getItem('auth_token');
    return token ? { Authorization: `Bearer ${token}` } : {};
};

// Exemplo de uso com fetch:
export const apiClient = {
    // Login Admin
    loginAdmin: async (login: string, password: string) => {
        const response = await fetch(`${API_CONFIG.baseURL}/auth/login/admin`, {
            method: 'POST',
            headers: API_CONFIG.headers,
            body: JSON.stringify({ login, password }),
        });
        return response.json();
    },

    // Login Aluno
    loginStudent: async (login: string, password: string) => {
        const response = await fetch(`${API_CONFIG.baseURL}/auth/login/student`, {
            method: 'POST',
            headers: API_CONFIG.headers,
            body: JSON.stringify({ login, password }),
        });
        return response.json();
    },

    // Logout
    logout: async () => {
        const response = await fetch(`${API_CONFIG.baseURL}/auth/logout`, {
            method: 'POST',
            headers: { ...API_CONFIG.headers, ...getAuthHeader() },
        });
        return response.json();
    },

    // Buscar usuário autenticado
    getMe: async () => {
        const response = await fetch(`${API_CONFIG.baseURL}/auth/me`, {
            headers: { ...API_CONFIG.headers, ...getAuthHeader() },
        });
        return response.json();
    },

    // Listar alunos
    getStudents: async () => {
        const response = await fetch(`${API_CONFIG.baseURL}/students`, {
            headers: { ...API_CONFIG.headers, ...getAuthHeader() },
        });
        return response.json();
    },

    // Criar aluno
    createStudent: async (data: { name: string; login: string; password: string }) => {
        const response = await fetch(`${API_CONFIG.baseURL}/students`, {
            method: 'POST',
            headers: { ...API_CONFIG.headers, ...getAuthHeader() },
            body: JSON.stringify(data),
        });
        return response.json();
    },

    // Ativar/Desativar aluno
    toggleStudentStatus: async (id: number) => {
        const response = await fetch(`${API_CONFIG.baseURL}/students/${id}/toggle-status`, {
            method: 'PATCH',
            headers: { ...API_CONFIG.headers, ...getAuthHeader() },
        });
        return response.json();
    },

    // Deletar aluno
    deleteStudent: async (id: number) => {
        const response = await fetch(`${API_CONFIG.baseURL}/students/${id}`, {
            method: 'DELETE',
            headers: { ...API_CONFIG.headers, ...getAuthHeader() },
        });
        return response.json();
    },

    // Listar questões
    getQuestions: async () => {
        const response = await fetch(`${API_CONFIG.baseURL}/questions`, {
            headers: { ...API_CONFIG.headers, ...getAuthHeader() },
        });
        return response.json();
    },

    // Submeter prova
    submitExam: async (answers: (number | null)[]) => {
        const response = await fetch(`${API_CONFIG.baseURL}/exam/submit`, {
            method: 'POST',
            headers: { ...API_CONFIG.headers, ...getAuthHeader() },
            body: JSON.stringify({ answers }),
        });
        return response.json();
    },

    // Histórico de tentativas
    getExamHistory: async () => {
        const response = await fetch(`${API_CONFIG.baseURL}/exam/history`, {
            headers: { ...API_CONFIG.headers, ...getAuthHeader() },
        });
        return response.json();
    },

    // Estatísticas
    getExamStats: async () => {
        const response = await fetch(`${API_CONFIG.baseURL}/exam/stats`, {
            headers: { ...API_CONFIG.headers, ...getAuthHeader() },
        });
        return response.json();
    },
};

export default API_CONFIG;
