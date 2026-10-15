import { z } from 'zod';
import { useContext, useState } from 'react';
import { useForm } from 'react-hook-form';
import { zodResolver } from '@hookform/resolvers/zod';
import { LoaderCircle } from 'lucide-react';
import { toast } from 'sonner';
import { EmailField } from '../components/EmailField';
import { PasswordField } from '../components/PasswordField';
import { Button } from '../components/Button';
import { Anchor } from '../components/Anchor';
import { AuthContext } from '../contexts/AuthContext';
import { Navigate } from 'react-router-dom';

const loginFormSchema = z.object({
  email: z.string().email({
    message: 'Digite um email válido',
  }),
  password: z.string().min(3, {
    message: 'Digite uma senha válida'
  })
});

export function Login() {
  const { isAuth, signIn } = useContext(AuthContext);

  const [isSendingForm, setIsSendingForm] = useState(false);

  const { handleSubmit, register, formState: { errors } } = useForm({
    resolver: zodResolver(loginFormSchema)
  });

  async function handleLogin({ email, password }) {
    setIsSendingForm(true);

    const response = await signIn({ email, password });

    if (response) {
      setIsSendingForm(false);
      toast.success('Usuário logado com sucesso!');
      window.location.href = '/pacientes';
    } else {
      setIsSendingForm(false);
      toast.error('Email ou senha incorreto');
    }
  }

  if (isAuth) {
    return <Navigate to="/pacientes" replace />;
  }

  return (
    <form
      onSubmit={handleSubmit(handleLogin)}
      className="my-6 flex flex-col gap-6"
    >
      <div className="flex flex-col gap-3">
        <EmailField
          placeholder="Digite seu email"
          {...register('email')}
          error={errors?.email}
        />
      </div>
      <div className="flex flex-col gap-3">
        <PasswordField
          placeholder="Digite sua senha"
          {...register('password')}
          error={errors?.password}
        />
      </div>
      <Anchor to="/">Esqueci a senha</Anchor>
      <Button type="submit" disabled={isSendingForm}>
        {isSendingForm && (
          <LoaderCircle className="animate-spin" />
        )}
          Entrar
      </Button>
      <p className="text-text flex flex-row items-center gap-1">
          Ainda não tem uma conta?
        <Anchor to="/cadastro">Cadastre-se</Anchor>
      </p>
    </form>
  );
}