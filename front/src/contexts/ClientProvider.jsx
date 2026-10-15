import { useContext, useEffect, useState } from 'react';
import { StreamVideo, StreamVideoClient } from '@stream-io/video-react-sdk';
import { AuthContext } from './AuthContext';
import { Loader2 } from 'lucide-react';
import { stream } from '../lib/stream';
import { v4 } from 'uuid';

export function ClientProvider({ children }) {
  const videoClient = useInitializeVideoClient();

  if (!videoClient) {
    return (
      <div className="h-screen flex items-center justify-center">
        <Loader2 className="mx-auto animate-spin" />
      </div>
    );
  }

  return (
    <StreamVideo client={videoClient}>
      {children}
    </StreamVideo>
  );
}

function useInitializeVideoClient() {
  const { onlineUser } = useContext(AuthContext);
  const [videoClient, setVideoClient] = useState(null);

  useEffect(() => {
    if (!onlineUser) {
      return;
    }

    let streamUser;

    if (onlineUser?.id) {
      streamUser = {
        id: onlineUser.id,
        name: onlineUser.name,
        image: onlineUser.avatar,
      };
    } else {
      const id = v4();
      streamUser = {
        id,
        type: 'guest',
        name: `Guest ${id}`
      };
    }

    stream.post('token', {
      streamAPIKey: import.meta.env.VITE_STREAM_API_KEY,
      streamAPISecret: import.meta.env.VITE_STREAM_API_SECRET,
      userId: onlineUser?.id,
    }).then((response => {
      const { token } = response.data;

      const client = new StreamVideoClient({
        apiKey: import.meta.env.VITE_STREAM_API_KEY,
        user: streamUser,
        tokenProvider: onlineUser?.id ? token : undefined
      });

      setVideoClient(client);

      return () => {
        client.disconnectUser();
        setVideoClient(null);
      };
    }));

  }, [onlineUser]);

  return videoClient;

}