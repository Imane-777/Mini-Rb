import { useState } from 'react';
import { Link, useNavigate } from 'react-router-dom';
import { useAuth } from '../contexts/AuthContext';
import Logo from '../components/Logo';

export default function Login() {
    const { login } = useAuth();
    const navigate = useNavigate();
    const [form, setForm] = useState({ email: '', password: '' });
    const [errors, setErrors] = useState({});
    const [submitting, setSubmitting] = useState(false);

    const handleChange = (e) => {
        setForm({ ...form, [e.target.name]: e.target.value });
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        setErrors({});
        setSubmitting(true);
        try {
            const me = await login(form.email, form.password);
            navigate(me.email_verified ? '/' : '/email/verify');
        } catch (err) {
            setErrors(err.response?.data?.errors || { email: ['Une erreur est survenue.'] });
        } finally {
            setSubmitting(false);
        }
    };

    return (
        <div className="bg-gray-100 min-h-screen flex items-center justify-center">
            <div className="bg-white p-8 rounded-2xl shadow-md w-full max-w-md">
                <div className="mb-6">
                    <Logo center />
                </div>
                <h3 className="text-xl mb-6 text-center font-semibold">Se connecter</h3>

                <form onSubmit={handleSubmit}>
                    <div className="mb-4">
                        <label className="block text-gray-700 font-semibold mb-1">Email</label>
                        <input
                            type="email"
                            name="email"
                            value={form.email}
                            onChange={handleChange}
                            className="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-rose-500"
                            required
                        />
                        {errors.email && <p className="text-red-500 text-sm mt-1">{errors.email[0]}</p>}
                    </div>

                    <div className="mb-6">
                        <label className="block text-gray-700 font-semibold mb-1">Mot de passe</label>
                        <input
                            type="password"
                            name="password"
                            value={form.password}
                            onChange={handleChange}
                            className="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-rose-500"
                            required
                        />
                        {errors.password && <p className="text-red-500 text-sm mt-1">{errors.password[0]}</p>}
                    </div>

                    <button
                        type="submit"
                        disabled={submitting}
                        className="w-full bg-rose-500 text-white py-3 rounded-lg font-bold hover:bg-rose-600 transition disabled:opacity-50"
                    >
                        {submitting ? 'Connexion...' : 'Se connecter'}
                    </button>
                </form>

                <p className="mt-4 text-center text-sm text-gray-500">
                    Pas encore de compte ?{' '}
                    <Link to="/register" className="text-rose-500 font-semibold">
                        S'inscrire
                    </Link>
                </p>
            </div>
        </div>
    );
}
