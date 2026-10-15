import { useState, useContext, useEffect } from 'react';
import { Button } from '../components/Button';
import { MeetingsTable } from '../components/MeetingsTable';
import { api } from '../lib/api';
import { AuthContext } from '../contexts/AuthContext';
import { DialogBackdrop, Dialog, DialogPanel, DialogTitle, Select } from '@headlessui/react';
import { X, Loader2 } from 'lucide-react';
import { useStreamVideoClient } from '@stream-io/video-react-sdk';
import { useNavigate } from 'react-router-dom';

export function Meeting() {
  const [meetings, setMeetings] = useState([]);
  const [events, setEvents] = useState([]);
  const { onlineUser } = useContext(AuthContext);
  const [isOpen, setIsOpen] = useState(false);
  const [eventId, setEventId] = useState('');

  const client = useStreamVideoClient();

  const [call, setCall] = useState();

  const navigate = useNavigate();

  useEffect(() => {
    getMeetings();
    getAllEvents();
  }, [onlineUser]);

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

  async function getMeetings() {
    try {
      if (onlineUser) {
        const response = await api.get('/meeting/'.concat(onlineUser.id));

        if (response && response.data) {
          setMeetings(response.data);
        }
      }

    } catch (err) {
      console.log(err);
    }
  }

  async function handleCreateMeeting() {
    try {
      if (onlineUser) {
        const response = await api.post('/meeting', {
          eventId,
          nutritionistId: onlineUser?.id,
        });

        if (response && response.data) {
          const { id } = response.data;

          if (!client) {
            return;
          }

          const call = client.call('default', id);

          await call.getOrCreate({
            data: {
              custom: {
                description: 'desc',
              }
            }
          });

          setCall(call);

          navigate(`/meeting/${call.id}`);
        }

      }

    } catch (err) {
      console.log(err);
    }
  }

  if (!client) {
    return <Loader2 className="mx-auto animate-spin" />;
  }

  return (
    <div className="w-full">
      <div className="flex justify-between items-center w-full mb-4">
        <h1 className="text-4xl font-bold text-title">
          Reuniões
        </h1>
        <Button
          onClick={() => setIsOpen(true)}
        >
          Nova Reunião
        </Button>
      </div>

      <Dialog open={isOpen} onClose={() => setIsOpen(false)} className="relative z-50">
        <DialogBackdrop className="fixed inset-0 bg-black/30" />
        <div className="fixed inset-0 flex w-screen items-center justify-center p-4">
          <DialogPanel className="min-[400px] w-[450px] bg-white p-8 rounded-2xl">
            <div className="flex flex-row items-center justify-between">
              <DialogTitle className="font-bold text-2xl text-title">Criar reunião</DialogTitle>
              <button onClick={() => setIsOpen(false)} className="px-2 text-text">
                <X />
              </button>
            </div>
            <div className="flex flex-col gap-2">
              <Select
                name="status"
                aria-label="Evento"
                className="w-full border border-1 border-border rounded text-sm placeholder-placeholder text-inputText inset-0 focus-within:border-2 focus-within:border-outline py-4 px-3 w-full outline-none rounded"
                onChange={(e) => setEventId(e.target.value)}
              >
                <option value="active">Evento</option>
                {events?.map(event => {
                  return (
                    <option key={event.id} value={event.id}>{event.title}</option>
                  );
                })}
              </Select>
            </div>
            <form  className="mt-8 flex flex-col gap-6">
              <Button type="button" onClick={() => handleCreateMeeting()}>
                {/* {isSendingInvite && <LoaderCircle className="animate-spin" />} */}
                  Criar
              </Button>
              {/* {call && <a href={`/meeting/${call.id}`}>Go to call</a>} */}
            </form>
          </DialogPanel>
        </div>
      </Dialog>

      <MeetingsTable data={meetings} />
    </div>
  );
};
