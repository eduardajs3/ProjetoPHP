import { useEffect, useState } from 'react';
import { PatientTable } from '../components/PatientTable';
import { Button } from '../components/Button';
import { EmailField } from '../components/EmailField';
import { Dialog, DialogPanel, DialogTitle, DialogBackdrop } from '@headlessui/react';
import { X, MailCheck, LoaderCircle } from 'lucide-react';
import { toast } from 'sonner';
import { api } from '../lib/api';
import { z } from 'zod';
import { useForm } from 'react-hook-form';
import { zodResolver } from '@hookform/resolvers/zod';

const inviteFormSchema = z.object({
  email: z.string().email({
    message: 'Digite um email válido',
  }),
});

export function Patients() {
  const [patients, setPatients] = useState([]);
  const [isOpen, setIsOpen] = useState(false);
  const [isSendingInvite, setIsSendingInvite] = useState(false);
  const [inviteSent, setInviteSent] = useState(false);

  const { handleSubmit, register, formState: { errors } } = useForm({
    resolver: zodResolver(inviteFormSchema)
  });

  useEffect(() => {
    getAllPatients();
  }, []);

  async function handleInvitePatient({ email }) {
    setIsSendingInvite(true);

    const response = await api.post('/invite', {
      email
    });

    if (response.status === 200) {
      setInviteSent(true);
      setIsSendingInvite(false);
      toast.success('Convite enviado com sucesso!');
      return;
    }

    setInviteSent(true);
    setIsSendingInvite(false);
    toast.error('Erro ao enviar convite. Verifique se o endereço de email está correto.');
  }

  async function getAllPatients() {
    try {
      const response = await api.get('/patients');

      if (response && response.data) {
        setPatients(response.data);
      }
    } catch (err) {
      console.log(err);
    }
  }


  return (
    <div className="w-full">
      <div className="flex justify-between items-center w-full mb-4">
        <h1 className="text-4xl font-bold text-title">
          Pacientes
        </h1>
        <Button
          onClick={() => setIsOpen(true)}
        >
          Invite
        </Button>
      </div>
      <Dialog open={isOpen} onClose={() => {
        setInviteSent(false);
        setIsOpen(false);
      }} className="relative z-50">
        <DialogBackdrop className="fixed inset-0 bg-black/30" />
        <div className="fixed inset-0 flex w-screen items-center justify-center p-4">
          <DialogPanel className="w-[500px] bg-white p-8 rounded-2xl">
            <div className="flex flex-row items-center justify-between">
              <DialogTitle className="font-bold text-2xl text-title">Convidar paciente</DialogTitle>
              <button onClick={() => {
                setInviteSent(false);
                setIsOpen(false);
              }} className="px-2 text-text">
                <X />
              </button>
            </div>
            {!inviteSent ? (
              <form className="mt-8 flex flex-col gap-6" onSubmit={handleSubmit(handleInvitePatient)}>
                <EmailField
                  placeholder="Digite o e-mail da paciente"
                  {...register('email')}
                  error={errors?.email}
                />
                <Button type="submit" disabled={isSendingInvite}>
                  {isSendingInvite && <LoaderCircle className="animate-spin" />}
                  Convidar
                </Button>
              </form>
            ) : (
              <div className="flex flex-col gap-3 items-center my-8">
                <MailCheck className="text-green-500" size={32} />
                <p className="text-text">Convite enviado com sucesso!</p>
              </div>
            )}
          </DialogPanel>
        </div>
      </Dialog>

      <PatientTable data={patients} />

    </div>
  );
};
