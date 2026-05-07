import { createContext, useContext, useEffect, useState } from 'react';
import api from '../api';

const AuthContext = createContext(null);

export function AuthProvider({ children }) {
    const [user, setUser] = useState(null);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        const token = localStorage.getItem('token');
        if (!token) {
            setLoading(false);
            return;
        }
        api.get('/user')
            .then((res) => setUser(res.data))
            .catch(() => {
                localStorage.removeItem('token');
                setUser(null);
            })
            .finally(() => setLoading(false));
    }, []);

    const login = async (email, password) => {
        const { data } = await api.post('/login', { email, password });
        localStorage.setItem('token', data.token);
        const me = await api.get('/user');
        setUser(me.data);
        return me.data;
    };

    const register = async (payload) => {
        const { data } = await api.post('/register', payload);
        localStorage.setItem('token', data.token);
        const me = await api.get('/user');
        setUser(me.data);
        return me.data;
    };

    const logout = async () => {
        try {
            await api.post('/logout');
        } catch (e) {
            // ignore
        }
        localStorage.removeItem('token');
        setUser(null);
    };

    const refreshUser = async () => {
        const { data } = await api.get('/user');
        setUser(data);
        return data;
    };

    return (
        <AuthContext.Provider value={{ user, loading, login, register, logout, refreshUser }}>
            {children}
        </AuthContext.Provider>
    );
}

export function useAuth() {
    return useContext(AuthContext);
}
