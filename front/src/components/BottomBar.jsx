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

export function BottomBar() {
  const location = useLocation();
  const { pathname } = location;

  return (
    <div className="fixed lg:hidden z-10 bottom-0 w-full h-24 bg-white">
      <div className="w-full h-24 flex flex-row items-center justify-between gap-8 px-4">
        <Link to={'/agenda'} className={`flex flex-col items-center gap-2 text-xs ${pathname === '/agenda' ? 'text-primary font-bold' : 'text-text'}`}>
          <CalendarFold />
          Agenda
        </Link>
        <Link to={'/pacientes'} className={`flex flex-col items-center gap-2 text-xs ${pathname === '/pacientes' ? 'text-primary font-bold' : 'text-text'}`}>
          <UsersRound />
          Pacientes
        </Link>
        {/* <Link to={'/dashboard'} className={`flex flex-col items-center gap-2 text-xs ${pathname === '/dashboard' ? 'text-primary font-bold' : 'text-text'}`}>
          <LayoutDashboard />
          Dashboard
        </Link> */}
        <Link to={'/reuniao'} className={`flex flex-col items-center gap-2 text-xs ${pathname === '/reuniao' ? 'text-primary font-bold' : 'text-text'}`}>
          <Video />
          Meeting
        </Link>
      </div>
    </div>
  );
}