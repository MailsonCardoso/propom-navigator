import { MessageCircle } from "lucide-react";

const WhatsAppButton = () => {
  const phoneNumber = "5598988221217";
  const message = encodeURIComponent(
    "Olá, gostaria de informações sobre o SIMULADO PREPOM 2026."
  );
  const whatsappUrl = `https://wa.me/${phoneNumber}?text=${message}`;

  return (
    <a
      href={whatsappUrl}
      target="_blank"
      rel="noopener noreferrer"
      className="fixed bottom-6 right-6 z-50 flex items-center justify-center w-14 h-14 rounded-full bg-[#25D366] text-white shadow-elevated hover:scale-110 transition-transform duration-300 group"
      aria-label="Contato via WhatsApp"
    >
      <MessageCircle className="w-7 h-7" fill="currentColor" />
      <span className="absolute right-full mr-3 px-3 py-2 rounded-lg bg-card text-foreground text-sm font-medium opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap shadow-card">
        Fale conosco
      </span>
      <span className="absolute inset-0 rounded-full bg-[#25D366] animate-pulse-ring -z-10" />
    </a>
  );
};

export default WhatsAppButton;
