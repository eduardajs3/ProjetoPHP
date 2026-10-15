import { createContext, useEffect, useState } from 'react';
import { useNavigate } from 'react-router-dom';
import { api } from '../lib/api';
import { jwtDecode } from 'jwt-decode';

export const AuthContext = createContext({});

export function AuthContextProvider({ children }) {
  const navigate = useNavigate();
  const isAuth = !!localStorage.getItem('fluxora.token');
  const [onlineUser, setOnlineUser] = useState(null);

  useEffect(() => {
    const user = localStorage.getItem('fluxora.user');

    if (user) {
      const parsedUser = JSON.parse(user);

      setOnlineUser(parsedUser);
    }
  }, [isAuth]);

  async function signIn({ email, password }) {
    try {
      const response = await api.post('/nutritionist/auth', {
        email,
        password,
      });

      const { token } = response.data;
      const { exp, user } = jwtDecode(token);

      localStorage.setItem('fluxora.token', JSON.stringify({
        token,
        exp,
      }));

      localStorage.setItem('fluxora.user', JSON.stringify(user));
      return true;
    } catch (err) {
      if (err.status === 401) {
        return false;
      }
    }
  }

  async function signOut() {
    localStorage.removeItem('fluxora.token');
    localStorage.removeItem('fluxora.user');
    navigate('/login', { replace: true });
  }

  return (
    <AuthContext.Provider value={{ signIn, signOut, isAuth, onlineUser }}>
      {children}
    </AuthContext.Provider>
  );
}