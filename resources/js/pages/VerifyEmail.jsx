import { useEffect, useState } from 'react';
import { Navigate } from 'react-router-dom';
import { useAuth } from '../contexts/AuthContext';
import api from '../api';

export default function VerifyEmail() {
    const { user, loading, logout, refreshUser } = useAuth();
    const [message, setMessage] = useState(null);
    const [resending, setResending] = useState(false);

    useEffect(() => {
        if (!user) return;
        const interval = setInterval(() => {
            refreshUser().catch(() => {});
        }, 5000);
        return () => clearInterval(interval);
    }, [user, refreshUser]);

    if (loading) return null;
    if (!user) return <Navigate to="/login" replace />;
    if (user.email_verified) return <Navigate to="/" replace />;

    const handleResend = async () => {
        setResending(true);
        setMessage(null);
        try {
            const { data } = await api.post('/email/verification-notification');
            setMessage(data.message);
        } catch (err) {
            setMessage('Une erreur est survenue.');
        } finally {
            setResending(false);
        }
    };

    return (
        <div className="bg-gray-100 min-h-screen flex items-center justify-center">
            <div className="bg-white p-8 rounded-2xl shadow-md w-full max-w-md text-center">
                <div className="text-rose-500 font-bold text-2xl mb-6">Mini-Rb</div>

                <div className="text-5xl mb-4">📧</div>
                <h2 className="text-2xl font-bold mb-2">Vérifiez votre email</h2>
                <p className="text-gray-500 mb-6">
                    Nous avons envoyé un lien de vérification à votre adresse email.
                    Cliquez sur le lien pour activer votre compte.
                </p>

                {message && (
                    <div className="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {message}
                    </div>
                )}

                <button
                    type="button"
                    onClick={handleResend}
                    disabled={resending}
                    className="w-full bg-rose-500 text-white py-3 rounded-lg font-semibold hover:bg-rose-600 transition disabled:opacity-50"
                >
                    {resending ? 'Envoi...' : 'Renvoyer le lien de vérification'}
                </button>

                <button
                    type="button"
                    onClick={logout}
                    className="text-gray-400 hover:text-gray-600 text-sm mt-4"
                >
                    Se déconnecter
                </button>
            </div>
        </div>
    );
}
