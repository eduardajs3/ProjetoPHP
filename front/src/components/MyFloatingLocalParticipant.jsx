import { ParticipantView } from '@stream-io/video-react-sdk';

// ... rest of the App.tsx code

export const MyFloatingLocalParticipant = (props) => {
  const { participant } = props;
  return (
    <div>
      <ParticipantView participant={participant} />
    </div>
  );
};