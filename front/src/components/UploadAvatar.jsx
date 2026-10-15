import { useState } from 'react';
import { Button } from './Button';
import { UploadIcon } from './Icons/UploadIcon';
import { X } from 'lucide-react';
import { api } from '../lib/api';
import { useNavigate } from 'react-router-dom';

export function UploadAvatar({ nutritionistId }) {
  const [avatar, setAvatar] = useState('');
  const [uploadPercentage, setUploadPercentage] = useState(0);
  const navigate = useNavigate();

  async function handleAvatarChange(event) {
    const file = event.target.files[0];
    if (!file) {
      return;
    }

    const formData = new FormData();
    formData.append('image', file);

    const response = await api.post(`/nutritionists/upload/${nutritionistId}`, formData, {
      headers: {
        'Content-Type': 'multipart/form-data',
      },
      onUploadProgress: (progressEvent) => {
        const percentCompleted = Math.round(
          (progressEvent.loaded * 100) / progressEvent.total
        );
        setUploadPercentage(percentCompleted);
      },
    });

    if (response && response.data) {
      const reader = new FileReader();
      reader.onloadend = () => {
        setAvatar(reader.result);
      };
      reader.readAsDataURL(file);
    }

  };

  return (
    <div className="my-6 flex flex-col gap-6">
      <input type="file" id="avatar-upload" onChange={handleAvatarChange} hidden />
      {!avatar ? (
        <label htmlFor="avatar-upload" className="p-11 bg-box size-[120px] rounded-xl hover:opacity-80 cursor-pointer">
          {uploadPercentage > 0 ? <span className="text-xs text-text">{uploadPercentage} %</span> : <UploadIcon />}
        </label>
      ) : (
        <div className="size-[120px] relative">
          <button
            className="absolute p-1 bg-red-500 rounded-full flex items-center justify-center m-[-4px] right-0 transtition hover:opacity-80"
            onClick={() => setAvatar('')}
          >
            <X className="text-white" size={16} />
          </button>
          <img src={avatar} alt="Avatar" className="rounded-xl" />
        </div>
      )}
      {uploadPercentage === 100 && (
        <Button onClick={() => navigate('/confirmacao-email')}>Finalizar</Button>
      )}
      {/* <Button outline={true}>Pular</Button> */}
    </div>
  );
}