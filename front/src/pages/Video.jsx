import { CallControls, SpeakerLayout, StreamCall, StreamTheme, useStreamVideoClient } from '@stream-io/video-react-sdk';
import { Loader2 } from 'lucide-react';
import { useState } from 'react';
import { useParams } from 'react-router-dom';
import { Button } from '../components/Button';

export function Video() {
  const { id } = useParams();

  const [call, setCall] = useState();

  const client = useStreamVideoClient();

  if (!client) {
    return <Loader2 className="mx-auto animate-spin" />;
  }

  if (!call) {
    return (
      <div className="h-screen flex items-center justify-center">
        <div className="mx-auto flex flex-col items-center gap-4">
          <p>Código da reunião: {id}</p>
          <p>Link: <a href={`/meeting/${id}`}>{import.meta.VITE_BASE_URL}/meeting/{id}</a></p>
          <Button
            onClick={async () => {
              const call = client.call('default', id);
              await call.join();
              setCall(call);
            }}
          >
            Entrar na reunião
          </Button>
        </div>
      </div>
    );
  }

  return (
    <div className="h-screen bg-slate-800">
      <StreamCall call={call}>
        <StreamTheme className="space-y-3">
          <SpeakerLayout />
          <CallControls />
        </StreamTheme>
      </StreamCall>
    </div>
  );
}