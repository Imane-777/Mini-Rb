import { useEffect, useState } from 'react';
import { Link } from 'react-router-dom';
import api from '../api';
import Layout from '../components/Layout';
import { ErrorAlert, SuccessAlert } from '../components/Alert';

export default function Profile() {
    const [data, setData] = useState(null);
    const [form, setForm] = useState({ name: '', email: '', password: '', password_confirmation: '' });
    const [success, setSuccess] = useState(null);
    const [errors, setErrors] = useState(null);
    const [submitting, setSubmitting] = useState(false);

    useEffect(() => {
        api.get('/profile').then((res) => {
            setData(res.data);
            setForm({
                name: res.data.user.name,
                email: res.data.user.email,
                password: '',
                password_confirmation: '',
            });
        });
    }, []);

    const handleChange = (e) => setForm({ ...form, [e.target.name]: e.target.value });

    const handleSubmit = async (e) => {
        e.preventDefault();
        setErrors(null);
        setSuccess(null);
        setSubmitting(true);
        try {
            const { data: res } = await api.put('/profile', form);
            setSuccess(res.message);
            setForm({ ...form, password: '', password_confirmation: '' });
            const fresh = await api.get('/profile');
            setData(fresh.data);
        } catch (err) {
            setErrors(err.response?.data?.errors);
        } finally {
            setSubmitting(false);
        }
    };

    if (!data) return <Layout><p className="p-10 text-gray-400">Chargement...</p></Layout>;

    const { user, stats, annonces } = data;

    return (
        <Layout>
            <main className="max-w-3xl mx-auto px-8 py-10">
                <SuccessAlert message={success} />
                <ErrorAlert errors={errors} />

                <h1 className="text-3xl font-bold mb-10">Mon Profil</h1>

                <div className="bg-white rounded-2xl shadow-sm border p-8 mb-8">
                    <div className="flex items-center gap-6 mb-8">
                        <div className="w-20 h-20 rounded-full bg-rose-100 flex items-center justify-center text-rose-500 text-3xl font-bold">
                            {user.name.charAt(0).toUpperCase()}
                        </div>
                        <div>
                            <h2 className="text-2xl font-bold">{user.name}</h2>
                            <p className="text-gray-500">{user.email}</p>
                            <div className="flex items-center gap-2 mt-1">
                                {user.email_verified ? (
                                    <span className="bg-green-100 text-green-700 text-xs font-semibold px-2 py-1 rounded-full">✓ Email vérifié</span>
                                ) : (
                                    <span className="bg-yellow-100 text-yellow-700 text-xs font-semibold px-2 py-1 rounded-full">⚠ Email non vérifié</span>
                                )}
                                <span className="bg-gray-100 text-gray-600 text-xs font-semibold px-2 py-1 rounded-full">
                                    {user.role.charAt(0).toUpperCase() + user.role.slice(1)}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div className="grid grid-cols-3 gap-4 mb-8 border-t pt-6">
                        <Stat value={stats.annonces} label="Annonces publiées" />
                        <Stat value={stats.reservations} label="Réservations effectuées" />
                        <Stat value={new Date(user.created_at).getFullYear()} label="Membre depuis" />
                    </div>

                    <form onSubmit={handleSubmit}>
                        <h3 className="text-lg font-bold mb-4">Modifier mes informations</h3>

                        <div className="space-y-4">
                            <div>
                                <label className="block text-gray-700 font-semibold mb-1">Nom</label>
                                <input
                                    type="text" name="name" value={form.name} onChange={handleChange}
                                    className="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-rose-500"
                                    required
                                />
                            </div>

                            <div>
                                <label className="block text-gray-700 font-semibold mb-1">Email</label>
                                <input
                                    type="email" name="email" value={form.email} onChange={handleChange}
                                    className="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-rose-500"
                                    required
                                />
                                <p className="text-xs text-gray-400 mt-1">Si vous changez votre email, vous devrez le vérifier à nouveau.</p>
                            </div>

                            <div>
                                <label className="block text-gray-700 font-semibold mb-1">
                                    Nouveau mot de passe <span className="text-gray-400 font-normal">(laisser vide pour ne pas changer)</span>
                                </label>
                                <input
                                    type="password" name="password" value={form.password} onChange={handleChange}
                                    className="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-rose-500"
                                />
                            </div>

                            <div>
                                <label className="block text-gray-700 font-semibold mb-1">Confirmer le nouveau mot de passe</label>
                                <input
                                    type="password" name="password_confirmation" value={form.password_confirmation} onChange={handleChange}
                                    className="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-rose-500"
                                />
                            </div>
                        </div>

                        <button
                            type="submit"
                            disabled={submitting}
                            className="mt-6 bg-rose-500 text-white px-8 py-3 rounded-lg font-bold hover:bg-rose-600 transition disabled:opacity-50"
                        >
                            {submitting ? 'Enregistrement...' : 'Enregistrer les modifications'}
                        </button>
                    </form>
                </div>

                {annonces.length > 0 && (
                    <div className="bg-white rounded-2xl shadow-sm border p-8">
                        <h3 className="text-lg font-bold mb-6">Mes annonces</h3>
                        <div className="space-y-4">
                            {annonces.map((a) => (
                                <div key={a.id} className="flex items-center justify-between border rounded-xl p-4">
                                    <div className="flex items-center gap-4">
                                        <div className="w-16 h-16 rounded-lg overflow-hidden flex-shrink-0">
                                            {a.image_url ? (
                                                <img src={a.image_url} className="w-full h-full object-cover" alt={a.titre} />
                                            ) : (
                                                <div className="w-full h-full bg-gray-200 flex items-center justify-center text-gray-400 text-xs">No img</div>
                                            )}
                                        </div>
                                        <div>
                                            <Link to={`/annonces/${a.id}`} className="font-semibold hover:text-rose-500">
                                                {a.titre}
                                            </Link>
                                            <p className="text-gray-500 text-sm">{a.ville} · {a.prix_par_nuit}$/nuit</p>
                                        </div>
                                    </div>
                                    <div className="flex gap-2">
                                        <Link to={`/annonces/${a.id}/edit`} className="text-sm bg-gray-100 px-3 py-1 rounded-lg hover:bg-gray-200 font-semibold">
                                            Modifier
                                        </Link>
                                    </div>
                                </div>
                            ))}
                        </div>
                    </div>
                )}
            </main>
        </Layout>
    );
}

function Stat({ value, label }) {
    return (
        <div className="text-center">
            <p className="text-2xl font-bold text-rose-500">{value}</p>
            <p className="text-gray-500 text-sm">{label}</p>
        </div>
    );
}
