import { useContext, useEffect, useState } from 'react';
import { useCalendarApp, ScheduleXCalendar } from '@schedule-x/react';
import {
  createViewDay,
  createViewMonthAgenda,
  createViewMonthGrid,
  createViewWeek,
} from '@schedule-x/calendar';
import { createEventsServicePlugin } from '@schedule-x/events-service';

import '@schedule-x/theme-default/dist/index.css';
import { createEventModalPlugin } from '@schedule-x/event-modal';
import { createDragAndDropPlugin } from '@schedule-x/drag-and-drop';

import { Button } from '../components/Button';
import { DialogBackdrop, Dialog, DialogPanel, DialogTitle } from '@headlessui/react';
import { X } from 'lucide-react';
import { TextField } from '../components/TextField';
import { InputDate } from '../components/InputDate';
import { z } from 'zod';
import { useForm } from 'react-hook-form';
import { zodResolver } from '@hookform/resolvers/zod';
import { api } from '../lib/api';
import { AuthContext } from '../contexts/AuthContext';
import { toast } from 'sonner';

const createEventFormSchema = z.object({
  title: z.string().min(1, {
    message: 'Título inválido',
  }),
  startDate: z.string() .refine((val) => !isNaN(Date.parse(val)), {
    message: 'Data inválida',
  })
    .transform((val) => new Date(val).toISOString()),
  endDate: z.string() .refine((val) => !isNaN(Date.parse(val)), {
    message: 'Data inválida',
  })
    .transform((val) => new Date(val).toISOString()),
  status: z.string().min(1, {
    message: 'Status inválido',
  }),
});

export function Calendar() {
  const plugins = [createEventsServicePlugin(), createDragAndDropPlugin(), createEventModalPlugin()];
  const [isOpen, setIsOpen] = useState(false);
  const [events, setEvents] = useState([]);

  const { handleSubmit, register, reset, formState: { errors } } = useForm({
    resolver: zodResolver(createEventFormSchema)
  });

  async function getAllEvents() {
    try {
      const response = await api.get('/events');

      if (response && response.data) {
        const data = response.data;

        const updatedData = data.map(({ id, name, start_date, end_date }) => ({
          id,
          title: name,
          start: start_date.split('T')[0],
          end: end_date.split('T')[0],
        }));

        setEvents(updatedData);
      }

    } catch (err) {
      console.log(err);
    }
  }

  async function handleCreateEvent({
    title,
    startDate,
    endDate,
    status,
  }) {

    const response = await api.post('/events', {
      name: title,
      status,
      startDate,
      endDate,
    });

    if (response && response.status === 200) {
      getAllEvents();
      toast.success('Evento criado com sucesso!');
      setIsOpen(false);
      return;
    }

    setIsOpen(false);
    reset();
  }

  const calendar = useCalendarApp({
    views: [
      createViewDay(),
      createViewWeek(),
      createViewMonthGrid(),
      createViewMonthAgenda(),
    ],
    events: [
      {
        id: 1,
        title: 'Event 1',
        start: '2024-11-03 00:00',
        end: '2024-11-03 06:00',
        description: 'My cool description',
      },
      {
        id: 2,
        title: 'Consulta',
        start: '2024-11-04 00:00',
        end: '2024-11-04 06:00',
      },
    ],
  }, plugins);

  useEffect(() => {
    getAllEvents();

    if (events) {
      calendar.eventsService.set(events);
      calendar.eventsService.getAll();
    }

  }, [events]);

  return (
    <div>
      <div className="flex flex-row items-center justify-between mb-4">
        <h1 className="text-[32px] font-bold text-title">Agenda</h1>
        <Button onClick={() => setIsOpen(true)}>Novo agendamento</Button>
      </div>
      <Dialog open={isOpen} onClose={() => setIsOpen(false)} className="relative z-50">
        <DialogBackdrop className="fixed inset-0 bg-black/30" />
        <div className="fixed inset-0 flex w-screen items-center justify-center p-4">
          <DialogPanel className="w-auto bg-white p-8 rounded-2xl">
            <div className="flex flex-row items-center justify-between">
              <DialogTitle className="font-bold text-2xl text-title">Novo evento</DialogTitle>
              <button onClick={() => setIsOpen(false)} className="px-2 text-text">
                <X />
              </button>
            </div>
            <form onSubmit={handleSubmit(handleCreateEvent)} className="mt-8 flex flex-col gap-6">
              <div className="flex flex-col gap-2">
                <label className="text-sm text-text" htmlFor="title">Título do evento</label>
                <TextField
                  id="title"
                  placeholder="Título"
                  {...register('title')}
                  error={errors?.title}
                />
              </div>
              <div className="flex flex-row items-center gap-4">
                <div className="flex flex-col gap-2">
                  <label className="text-sm text-text" htmlFor="startDate">Data de início</label>
                  <InputDate
                    id="startDate"
                    {...register('startDate')}
                    error={errors?.startDate}
                  />
                </div>
                <div className="flex flex-col gap-2">
                  <label className="text-sm text-text" htmlFor="endDate">Data de termino</label>
                  <InputDate
                    id="endDate"
                    {...register('endDate')}
                    error={errors?.endDate}
                  />
                </div>
              </div>
              <div className="flex flex-col gap-2">
                <label className="text-sm text-text" htmlFor="status">Status do evento</label>
                <TextField
                  id="status"
                  placeholder="Status"
                  {...register('status')}
                  error={errors?.status}
                />
              </div>
              <Button type="submit">
                {/* {isSendingInvite && <LoaderCircle className="animate-spin" />} */}
                  Agendar
              </Button>
            </form>
          </DialogPanel>
        </div>
      </Dialog>
      <ScheduleXCalendar calendarApp={calendar} />
    </div>
  );
}