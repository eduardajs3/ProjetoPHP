import { AppRouter } from './AppRouter';
import { Toaster } from 'sonner';
import { AuthContextProvider } from './contexts/AuthContext';

export function App() {
  return (
    <AuthContextProvider>
      <Toaster richColors />
      <AppRouter />
    </AuthContextProvider>
  );
}
