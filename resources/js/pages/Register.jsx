import { useState } from 'react';
import { Link, useNavigate } from 'react-router-dom';
import { useAuth } from '../contexts/AuthContext';
import Logo from '../components/Logo';

export default function Register() {
    const { register } = useAuth();
    const navigate = useNavigate();
    const [form, setForm] = useState({
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
    });
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
            await register(form);
            navigate('/email/verify');
        } catch (err) {
            setErrors(err.response?.data?.errors || {});
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
                <h3 className="text-xl mb-6 text-center font-semibold">Créer un compte</h3>

                <form onSubmit={handleSubmit}>
                    <Field label="Nom" name="name" value={form.name} onChange={handleChange} error={errors.name} required />
                    <Field label="Email" name="email" type="email" value={form.email} onChange={handleChange} error={errors.email} required />
                    <Field label="Mot de passe" name="password" type="password" value={form.password} onChange={handleChange} error={errors.password} required />
                    <Field label="Confirmer le mot de passe" name="password_confirmation" type="password" value={form.password_confirmation} onChange={handleChange} required />

                    <button
                        type="submit"
                        disabled={submitting}
                        className="w-full bg-rose-500 text-white py-3 rounded-lg font-bold hover:bg-rose-600 transition disabled:opacity-50"
                    >
                        {submitting ? 'Inscription...' : "S'inscrire"}
                    </button>
                </form>

                <p className="mt-4 text-center text-sm text-gray-500">
                    Déjà un compte ?{' '}
                    <Link to="/login" className="text-rose-500 font-semibold">
                        Se connecter
                    </Link>
                </p>
            </div>
        </div>
    );
}

function Field({ label, error, ...props }) {
    return (
        <div className="mb-4">
            <label className="block text-gray-700 font-semibold mb-1">{label}</label>
            <input
                {...props}
                className="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-rose-500"
            />
            {error && <p className="text-red-500 text-sm mt-1">{error[0]}</p>}
        </div>
    );
}
