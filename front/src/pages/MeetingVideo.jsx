import { useStreamVideoClient } from '@stream-io/video-react-sdk';
import { Loader2 } from 'lucide-react';
import { v4 } from 'uuid';
import { useState } from 'react';

export function MeetingVideo() {
  const client = useStreamVideoClient();

  const [call, setCall] = useState();

  async function createMeeting() {
    if (!client) {
      return;
    }

    try {
      const id = v4();

      const call = client.call('default', id);

      await call.getOrCreate({
        data: {
          custom: {
            description: 'teste',
          }
        }
      });

      setCall(call);
    } catch (error) {
      console.log(error);
    }
  }

  if (!client) {
    return <Loader2 className="mx-auto animate-spin" />;
  }

  return (
    <div>
      <button onClick={() => createMeeting()}>Create meeting</button>
      <br />
      {call && <a href={`/meeting/${call.id}`}>Go to call</a>}
    </div>
  );
}