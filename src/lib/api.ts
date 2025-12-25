export const API_BASE_URL = "http://192.168.176.30:8000/api";

export const getAuthHeaders = () => {
    const token = localStorage.getItem("auth_token");
    return {
        "Content-Type": "application/json",
        "Accept": "application/json",
        ...(token ? { "Authorization": `Bearer ${token}` } : {}),
    };
};

export const api = {
    get: async (endpoint: string) => {
        const response = await fetch(`${API_BASE_URL}${endpoint}`, {
            headers: getAuthHeaders(),
        });
        if (!response.ok) {
            throw new Error(`Error: ${response.status}`);
        }
        return response.json();
    },

    post: async (endpoint: string, data: any) => {
        const response = await fetch(`${API_BASE_URL}${endpoint}`, {
            method: "POST",
            headers: getAuthHeaders(),
            body: JSON.stringify(data),
        });
        if (!response.ok) {
            const errorData = await response.json().catch(() => ({}));
            throw new Error(errorData.message || `Error: ${response.status}`);
        }
        return response.json();
    },

    patch: async (endpoint: string, data?: any) => {
        const response = await fetch(`${API_BASE_URL}${endpoint}`, {
            method: "PATCH",
            headers: getAuthHeaders(),
            ...(data ? { body: JSON.stringify(data) } : {}),
        });
        if (!response.ok) {
            const errorData = await response.json().catch(() => ({}));
            throw new Error(errorData.message || `Error: ${response.status}`);
        }
        return response.json();
    },

    delete: async (endpoint: string) => {
        const response = await fetch(`${API_BASE_URL}${endpoint}`, {
            method: "DELETE",
            headers: getAuthHeaders(),
        });
        if (!response.ok) {
            const errorData = await response.json().catch(() => ({}));
            throw new Error(errorData.message || `Error: ${response.status}`);
        }
        return response.json();
    },
};
