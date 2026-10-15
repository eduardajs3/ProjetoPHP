import logo from '../assets/large-logo.png';
import userAvatar from '../assets/user.png';
import { Bell, LogOut, Settings } from 'lucide-react';
import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/react';
import { useContext } from 'react';
import { AuthContext } from '../contexts/AuthContext';

export function Header() {
  const { signOut, onlineUser } = useContext(AuthContext);

  return (
    <header className="z-10 fixed flex flex-row items-center justify-between bg-white w-full h-24 flex flex-row items-center px-4">
      <img src={logo} alt="Logo" className="w-[126px] h-[56px] my-12" />

      <div className="flex flex-row items-center gap-2">
        <div className="size-6 relative">
          <div className="absolute bg-secondary size-2 rounded-full right-1 top-0 border border-2 border-white"></div>
          <Bell className="text-text" size={24} />
        </div>
        <Menu>
          <MenuButton>
            <div className="size-12 relative">
              <div className="absolute bg-online size-3 rounded-full right-1 top-0 border border-2 border-white"></div>
              <img src={onlineUser?.avatar ? onlineUser.avatar : userAvatar} alt="Avatar" className="size-12 rounded-full" />
            </div>
          </MenuButton>
          <MenuItems anchor="bottom" className="bg-white z-40 shadow-sm p-1 w-64 border border-border rounded-lg transition ease-in-out">
            <div className="py-1.5 px-3 w-full border-b border-boder flex flex-col gap-2 mb-2">
              <h3 className="text-xl font-semibold text-title w-full">Olá, {onlineUser && onlineUser.name}</h3>
              <p className="text-sm text-text">{onlineUser && onlineUser.email}</p>
            </div>
            <MenuItem>
              <a
                className="block w-full flex flex-row items-center gap-2 data-[focus]:bg-slate-50 py-1.5 px-3 text-text rounded-lg"
                href="/ajustes"
              >
                <Settings size={16} />
                Preferências
              </a>
            </MenuItem>
            <MenuItem>

              <button
                className="block w-full flex flex-row items-center gap-2 hover:bg-slate-50 py-1.5 px-3 text-red-500 rounded-lg"
                onClick={() => signOut()}
              >
                <LogOut size={16} />
                Sair
              </button>
            </MenuItem>
          </MenuItems>
        </Menu>
      </div>
    </header>
  );
}