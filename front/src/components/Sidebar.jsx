import logo from '../assets/large-logo-white.png';

import {
  LayoutDashboard,
  UsersRound,
  CalendarFold,
  Video,
  MessageCircle,
  Settings,
  LogOut,
} from 'lucide-react';
import { useLocation, Link } from 'react-router-dom';

export function Sidebar() {
  const location = useLocation();
  const { pathname } = location;

  return (
    <div className="hidden fixed lg:h-screen z-10 lg:flex flex-col items-center bg-primary text-white max-w-[280px] rounded-custom">
      <img src={logo} alt="Logo" className="w-[126px] h-[56px] my-12" />
      {/* <Link to="/dashboard" className={`relative w-full flex flex-row items-center px-[77px] gap-4 font-semibold transition hover:text-white text-box h-[72px] ${pathname === '/' && 'text-white'}`}>
        {pathname === '/dashboard' && (
          <span className="absolute bg-white w-1.5 h-full left-0 rounded-custom"></span>
        )}
        <LayoutDashboard />
      Dashboard
      </Link> */}
      <Link to="/pacientes" className={`relative w-full flex flex-row items-center px-[77px] gap-4 font-semibold transition hover:text-white text-box h-[72px] ${pathname === '/pacientes' && 'text-white'}`}>
        {pathname === '/pacientes' && (
          <span className="absolute bg-white w-1.5 h-full left-0 rounded-custom"></span>
        )}
        <UsersRound />
      Pacientes
      </Link>
      <Link to="/agenda" className={`relative w-full flex flex-row items-center px-[77px] gap-4 font-semibold transition hover:text-white text-box h-[72px] ${pathname === '/agenda' && 'text-white'}`}>
        {pathname === '/agenda' && (
          <span className="absolute bg-white w-1.5 h-full left-0 rounded-custom"></span>
        )}
        <CalendarFold />
      Agenda
      </Link>
      <Link to="/reuniao" className={`relative w-full flex flex-row items-center px-[77px] gap-4 font-semibold transition hover:text-white text-box h-[72px] ${pathname === '/reuniao' && 'text-white'}`}>
        {pathname === '/reuniao' && (
          <span className="absolute bg-white w-1.5 h-full left-0 rounded-custom"></span>
        )}
        <Video />
      Meeting
      </Link>
      {/* <Link to="/conversas" className={`relative w-full flex flex-row items-center px-[77px] gap-4 font-semibold transition hover:text-white text-box h-[72px] ${pathname === '/conversas' && 'text-white'}`}>
        {pathname === '/conversas' && (
          <span className="absolute bg-white w-1.5 h-full left-0 rounded-custom"></span>
        )}
        <MessageCircle />
      Conversas
      </Link> */}
    </div>
  );
}