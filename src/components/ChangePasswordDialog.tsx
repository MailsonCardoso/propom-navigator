import { useState } from "react";
import { Lock, Loader2, Info } from "lucide-react";
import { Button } from "@/components/ui/button";
import {
    Dialog,
    DialogContent,
    DialogHeader,
    DialogTitle,
    DialogDescription,
    DialogFooter,
} from "@/components/ui/dialog";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { Alert, AlertDescription } from "@/components/ui/alert";
import { api } from "@/lib/api";

interface ChangePasswordDialogProps {
    isOpen: boolean;
    onOpenChange: (open: boolean) => void;
}

export function ChangePasswordDialog({ isOpen, onOpenChange }: ChangePasswordDialogProps) {
    const [password, setPassword] = useState("");
    const [passwordConfirmation, setPasswordConfirmation] = useState("");
    const [isLoading, setIsLoading] = useState(false);
    const [error, setError] = useState<string | null>(null);
    const [success, setSuccess] = useState(false);

    const handleSubmit = async (e: React.FormEvent) => {
        e.preventDefault();
        setIsLoading(true);
        setError(null);

        if (password.length < 6) {
            setError("A senha deve ter pelo menos 6 caracteres.");
            setIsLoading(false);
            return;
        }

        if (password !== passwordConfirmation) {
            setError("As senhas não conferem.");
            setIsLoading(false);
            return;
        }

        try {
            await api.patch("/auth/change-password", {
                password: password,
                password_confirmation: passwordConfirmation,
            });
            setSuccess(true);
            setPassword("");
            setPasswordConfirmation("");
            setTimeout(() => {
                onOpenChange(false);
                setSuccess(false);
            }, 2000);
        } catch (err: any) {
            setError(err.message || "Erro ao alterar a senha. Tente novamente.");
        } finally {
            setIsLoading(false);
        }
    };

    return (
        <Dialog open={isOpen} onOpenChange={onOpenChange}>
            <DialogContent className="sm:max-w-[425px]">
                <DialogHeader>
                    <DialogTitle className="flex items-center gap-2">
                        <Lock className="w-5 h-5 text-accent" />
                        Alterar Senha
                    </DialogTitle>
                    <DialogDescription>
                        Digite sua nova senha abaixo. Ela deve ter no mínimo 6 caracteres.
                    </DialogDescription>
                </DialogHeader>

                {success ? (
                    <div className="py-6 text-center">
                        <div className="w-12 h-12 rounded-full bg-success/10 flex items-center justify-center mx-auto mb-4">
                            <Lock className="w-6 h-6 text-success" />
                        </div>
                        <h3 className="text-lg font-bold text-success mb-2">Senha Alterada!</h3>
                        <p className="text-muted-foreground text-sm">Sua senha foi atualizada com sucesso.</p>
                    </div>
                ) : (
                    <form onSubmit={handleSubmit} className="space-y-4 py-4">
                        {error && (
                            <Alert variant="destructive">
                                <Info className="h-4 w-4" />
                                <AlertDescription>{error}</AlertDescription>
                            </Alert>
                        )}

                        <div className="space-y-2">
                            <Label htmlFor="password">Nova Senha</Label>
                            <Input
                                id="password"
                                type="password"
                                value={password}
                                onChange={(e) => setPassword(e.target.value)}
                                placeholder="No mínimo 6 caracteres"
                                required
                            />
                        </div>

                        <div className="space-y-2">
                            <Label htmlFor="password_confirmation">Confirmar Senha</Label>
                            <Input
                                id="password_confirmation"
                                type="password"
                                value={passwordConfirmation}
                                onChange={(e) => setPasswordConfirmation(e.target.value)}
                                placeholder="Repita a nova senha"
                                required
                            />
                        </div>

                        <DialogFooter className="pt-4">
                            <Button type="button" variant="ghost" onClick={() => onOpenChange(false)}>
                                Cancelar
                            </Button>
                            <Button type="submit" variant="navy" disabled={isLoading}>
                                {isLoading && <Loader2 className="w-4 h-4 mr-2 animate-spin" />}
                                Salvar Nova Senha
                            </Button>
                        </DialogFooter>
                    </form>
                )}
            </DialogContent>
        </Dialog>
    );
}
