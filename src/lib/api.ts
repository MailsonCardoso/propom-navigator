export const API_BASE_URL = "https://api.platformx.com.br/api";

export const getAuthHeaders = () => {
    const token = localStorage.getItem("auth_token");
    return {
        "Content-Type": "application/json",
        "Accept": "application/json",
        ...(token ? { "Authorization": `Bearer ${token}` } : {}),
    };
};

const handleResponse = async (response: Response) => {
    if (response.status === 401 || response.status === 403) {
        localStorage.removeItem("auth_token");
        if (!window.location.pathname.includes('/login') && window.location.pathname !== '/') {
            window.location.href = '/';
        }
    }

    if (!response.ok) {
        const errorData = await response.json().catch(() => ({}));
        throw new Error(errorData.message || `Error: ${response.status}`);
    }
    return response.json();
};

export const api = {
    get: async (endpoint: string) => {
        const response = await fetch(`${API_BASE_URL}${endpoint}`, {
            headers: getAuthHeaders(),
        });
        return handleResponse(response);
    },

    post: async (endpoint: string, data: any) => {
        const response = await fetch(`${API_BASE_URL}${endpoint}`, {
            method: "POST",
            headers: getAuthHeaders(),
            body: JSON.stringify(data),
        });
        return handleResponse(response);
    },

    put: async (endpoint: string, data: any) => {
        const response = await fetch(`${API_BASE_URL}${endpoint}`, {
            method: "PUT",
            headers: getAuthHeaders(),
            body: JSON.stringify(data),
        });
        return handleResponse(response);
    },

    patch: async (endpoint: string, data?: any) => {
        const response = await fetch(`${API_BASE_URL}${endpoint}`, {
            method: "PATCH",
            headers: getAuthHeaders(),
            ...(data ? { body: JSON.stringify(data) } : {}),
        });
        return handleResponse(response);
    },

    delete: async (endpoint: string) => {
        const response = await fetch(`${API_BASE_URL}${endpoint}`, {
            method: "DELETE",
            headers: getAuthHeaders(),
        });
        return handleResponse(response);
    },
};
