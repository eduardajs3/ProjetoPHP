import { Route, Routes } from 'react-router-dom';
import { Dashboard } from './pages/Dashboard';
import { RegisterLayout } from './components/RegisterLayout';
import { Layout } from './components/Layout';
import { Login } from './pages/Login';
import { CreateAccount } from './pages/CreateAccount';
import {Patients}from './pages/Patients';
import { Calendar } from './pages/Calendar';
import { Meeting } from './pages/Meeting';
import { Chat } from './pages/Chat';
import { Home } from './pages/Home';
import { MeetingVideo } from './pages/MeetingVideo';
import { ClientProvider } from './contexts/ClientProvider';
import { Video } from './pages/Video';
import { ConfirmAccount } from './pages/ConfirmAccount';
import { useLocation } from 'react-router-dom';


export function AppRouter() {
  const location = useLocation();

  return (
    <Routes>
      <Route
        path="/"
        element={
          <Home />
        }
      />
      {/* <Route
        path="/dashboard"
        element={
          <Layout>
            <Dashboard />
          </Layout>
        }
      /> */}
      <Route
        path="/pacientes"
        element={
          <Layout>
            <Patients key={location.pathname + location.search} />
          </Layout>
        }
      />
      <Route
        path="/agenda"
        element={
          <Layout>
            <Calendar key={location.pathname + location.search} />
          </Layout>
        }
      />
      <Route
        path="/reuniao"
        element={
          <Layout>
            <ClientProvider>
              <Meeting key={location.pathname + location.search} />
            </ClientProvider>
          </Layout>
        }
      />
      {/* <Route
        path="/conversas"
        element={
          <Layout>
            <Chat />
          </Layout>
        }
      /> */}
      <Route
        path="/login"
        element={
          <RegisterLayout
            title="Accesse sua conta"
            subtitle="Informe seu email e sua senha para entrar"
          >
            <Login />
          </RegisterLayout>
        }
      />
      <Route
        path="/cadastro"
        element={
          <RegisterLayout
            title="Crie sua conta"
            subtitle="Informe seus dados pessoais e de acesso"
          >
            <CreateAccount />
          </RegisterLayout>
        }
      />
      <Route
        path="/confirmacao-email"
        element={
          <RegisterLayout
            title="Confirme sua conta"
            subtitle="Verifique sua caixa de entrada"
          >
            <ConfirmAccount />
          </RegisterLayout>
        }
      />
      <Route
        path="/meeting"
        element={
          <ClientProvider>
            <MeetingVideo />
          </ClientProvider>
        }
      />
      <Route
        path="/meeting/:id"
        element={
          <ClientProvider>
            <Video />
          </ClientProvider>
        }
      />
    </Routes>
  );
}