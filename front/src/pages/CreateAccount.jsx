import { z } from 'zod';
import { useState, useContext } from 'react';
import { useForm } from 'react-hook-form';
import { zodResolver } from '@hookform/resolvers/zod';
import { LoaderCircle } from 'lucide-react';
import { EmailField } from '../components/EmailField';
import { PasswordField } from '../components/PasswordField';
import { TextField } from '../components/TextField';
import { Button } from '../components/Button';
import { UploadAvatar } from '../components/UploadAvatar';
import { Anchor } from '../components/Anchor';
import { AuthContext } from '../contexts/AuthContext';
import { Navigate } from 'react-router-dom';
import { api } from '../lib/api';

const createAccountFormSchema = z.object({
  name: z.string().min(3, {
    message: 'Digite um nome válido'
  }),
  email: z.string().email({
    message: 'Digite um email válido',
  }),
  password: z.string().min(6, {
    message: 'Digite uma senha válida'
  }),
  cnpj: z.string().min(14, {
    message: 'Digite um CNPJ válido'
  }),
});

export function CreateAccount() {
  const [isSendingForm, setIsSendingForm] = useState(false);
  const [formSent, setFormSent] = useState(false);
  const { isAuth } = useContext(AuthContext);
  const [nutritionistId, setNutritionistId] = useState('');

  const { handleSubmit, register, formState: { errors } } = useForm({
    resolver: zodResolver(createAccountFormSchema)
  });

  async function handleCreateAccount({ name, email, password, cnpj }) {
    setIsSendingForm(true);

    try {
      const response = await api.post('/nutritionists', {
        name,
        email,
        password,
        cnpj
      });

      if (response && response.data) {
        setNutritionistId(response.data.id);
        setIsSendingForm(false);
        setFormSent(true);
      }
    } catch (err) {
      console.log(err);
    }
  }

  if (isAuth) {
    return <Navigate to="/pacientes" replace />;
  }

  return (
    <>
      {!formSent ? (
        <form
          onSubmit={handleSubmit(handleCreateAccount)}
          className="my-6 flex flex-col gap-6"
        >
          <div className="flex flex-col gap-3">
            <TextField
              placeholder="Digite seu nome completo"
              {...register('name')}
              error={errors?.name}
            />
          </div>
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
          <div className="flex flex-col gap-3">
            <TextField
              placeholder="Digite seu CNPJ"
              {...register('cnpj')}
              error={errors?.cnpj}
            />
          </div>
          <Button type="submit" disabled={isSendingForm}>
            {isSendingForm && (
              <LoaderCircle className="animate-spin" />
            )}
              Continuar
          </Button>
          <p className="text-text flex flex-row items-center gap-1">
              Já tem uma conta?
            <Anchor to="/login">Entrar na conta</Anchor>
          </p>
        </form>
      ) : (
        <UploadAvatar nutritionistId={nutritionistId} />
      )}
    </>
  );
}