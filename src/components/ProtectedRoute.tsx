import { Navigate } from "react-router-dom";
import { useApp } from "@/contexts/AppContext";

interface ProtectedRouteProps {
    children: React.ReactNode;
    role?: "student" | "admin";
}

const ProtectedRoute = ({ children, role }: ProtectedRouteProps) => {
    const { isAuthenticated, user, isLoading } = useApp();

    if (isLoading) {
        return (
            <div className="min-h-screen flex items-center justify-center bg-background">
                <div className="animate-spin rounded-full h-12 w-12 border-b-2 border-navy"></div>
            </div>
        );
    }

    if (!isAuthenticated) {
        const loginPath = role === "admin" ? "/admin/login" : "/login";
        return <Navigate to={loginPath} replace />;
    }

    if (role && user?.role !== role) {
        return <Navigate to="/" replace />;
    }

    return <>{children}</>;
};

export default ProtectedRoute;
