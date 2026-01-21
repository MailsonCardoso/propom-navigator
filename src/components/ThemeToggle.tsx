import { Moon, Sun } from "lucide-react";
import { useTheme } from "next-themes";
import { useState, useEffect } from "react";
import { Button } from "@/components/ui/button";
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuTrigger,
} from "@/components/ui/dropdown-menu";

export function ThemeToggle() {
    const { setTheme, theme } = useTheme();
    const [mounted, setMounted] = useState(false);

    // Evita erro de hidratação (Next.js/Vite SSR)
    useEffect(() => {
        setMounted(true);
    }, []);

    if (!mounted) {
        return <div className="w-9 h-9" />; // Placeholder para manter o espaço
    }

    return (
        <DropdownMenu>
            <DropdownMenuTrigger asChild>
                <Button
                    variant="outline"
                    size="icon"
                    className="w-10 h-10 rounded-full bg-background border-2 border-primary/20 hover:border-primary/50 transition-all duration-300"
                >
                    <Sun className="h-[1.2rem] w-[1.2rem] rotate-0 scale-100 transition-all dark:-rotate-90 dark:scale-0 text-amber-500" />
                    <Moon className="absolute h-[1.2rem] w-[1.2rem] rotate-90 scale-0 transition-all dark:rotate-0 dark:scale-100 text-blue-500" />
                    <span className="sr-only">Alternar tema</span>
                </Button>
            </DropdownMenuTrigger>
            <DropdownMenuContent align="end" className="z-[100] bg-card border-border shadow-xl">
                <DropdownMenuItem onClick={() => setTheme("light")} className="cursor-pointer gap-2">
                    <Sun className="h-4 w-4 text-amber-500" />
                    <span className="font-medium">Modo Claro</span>
                </DropdownMenuItem>
                <DropdownMenuItem onClick={() => setTheme("dark")} className="cursor-pointer gap-2">
                    <Moon className="h-4 w-4 text-blue-500" />
                    <span className="font-medium">Modo Escuro</span>
                </DropdownMenuItem>
                <DropdownMenuItem onClick={() => setTheme("system")} className="cursor-pointer gap-2">
                    <div className="w-4 h-4 flex items-center justify-center text-[8px] font-bold bg-muted rounded">OS</div>
                    <span className="font-medium">Seguir Sistema</span>
                </DropdownMenuItem>
            </DropdownMenuContent>
        </DropdownMenu>
    );
}
