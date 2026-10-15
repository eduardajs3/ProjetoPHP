import { useContext } from 'react';
import { Header } from './Header';
import { Sidebar } from './Sidebar';
import { AuthContext } from '../contexts/AuthContext';
import { Navigate } from 'react-router-dom';
import { BottomBar } from './BottomBar';

export function Layout({ children }) {
  const { isAuth } = useContext(AuthContext);

  if (!isAuth) {
    return <Navigate to="/login" replace />;
  }

  return (
    <div className="flex flex-row">
      <Header />
      <Sidebar />
      <div className="mx-4 my-28 w-full lg:ml-[296px] lg:gmr-4">
        {children}
      </div>
      <BottomBar />
    </div>
  );
}