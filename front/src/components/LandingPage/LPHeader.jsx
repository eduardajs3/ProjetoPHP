import { useEffect, useState } from 'react';
import { Link, useLocation } from 'react-router-dom';
import { AlignJustify } from 'lucide-react';
import logo from '../../assets/large-logo.png';

export function LPHeader() {
  const [isScrolled, setIsScrolled] = useState(false);
  const location = useLocation();
  const { pathname, hash } = location;
  const path = pathname + hash;

  useEffect(() => {
    const handleScroll = () => {
      if (window.scrollY > 50) {
        setIsScrolled(true);
      } else {
        setIsScrolled(false);
      }
    };

    window.addEventListener('scroll', handleScroll);

    return () => {
      window.removeEventListener('scroll', handleScroll);
    };
  }, []);

  return (
    <header className={`h-[96px] transition z-20 fixed w-full top-0 ${isScrolled ? 'bg-white/40 backdrop-blur-2xl' : 'bg-transparent'}`}>
      <div className="px-4 lg:px-0 max-w-[1120px] h-[96px] mx-auto flex flex-row items-center justify-between">
        <Link to="/">
          <img src={logo} alt="logo" className="w-[120px]" />
        </Link>

        <button className="text-primary lg:hidden">
          <AlignJustify />
        </button>

        <nav id="mobileNav" className="hidden absolute w-full h-screen left-0 z-30 flex flex-col items-center justify-center gap-16 bg-white">
          <a href="/" className="text-title text-[20px] font-bold">
            Início
          </a>
          <a href="#about" className="text-title text-[20px] font-bold">
            Sobre
          </a>
          <a href="#princing" className="text-title text-[20px] font-bold">
            Planos
          </a>
          <a href="/#testimonies" className="text-title text-[20px] font-bold">
            Depoimentos
          </a>
          <a href="/#contact" className="text-title text-[20px] font-bold">
            Contato
          </a>
          <Link to="/login" className="text-title text-[20px] font-bold">
            Entrar
          </Link>
        </nav>

        <nav className="h-[96px] hidden lg:block">
          <a href="/" className={`inline-block leading-[96px] relative h-[96px] ml-8 ${path === '/' && 'font-semibold text-primary after:content-[\'\'] after:absolute after:left-0 after:bottom-0 after:bg-primary after:w-full after:h-[3px] after:rounded-tl-[3px] after:rounded-tr-[3px] after:rounded-bl-none after:rounded-br-none'}`}>
            Início
          </a>
          <a href="#about" className={`inline-block leading-[96px] relative h-[96px] ml-8 ${path.includes('/#about') && 'font-semibold text-primary after:content-[\'\'] after:absolute after:left-0 after:bottom-0 after:bg-primary after:w-full after:h-[3px] after:rounded-tl-[3px] after:rounded-tr-[3px] after:rounded-bl-none after:rounded-br-none'}`}>
            Sobre
          </a>
          <a href="#princing" className={`inline-block leading-[96px] relative h-[96px] ml-8 ${path.includes('/#princing') && 'font-semibold text-primary after:content-[\'\'] after:absolute after:left-0 after:bottom-0 after:bg-primary after:w-full after:h-[3px] after:rounded-tl-[3px] after:rounded-tr-[3px] after:rounded-bl-none after:rounded-br-none'}`}>
            Planos
          </a>
          <a href="/#testimonies" className={`inline-block leading-[96px] relative h-[96px] ml-8 ${path.includes('/#testimonies') && 'font-semibold text-primary after:content-[\'\'] after:absolute after:left-0 after:bottom-0 after:bg-primary after:w-full after:h-[3px] after:rounded-tl-[3px] after:rounded-tr-[3px] after:rounded-bl-none after:rounded-br-none'}`}>
            Depoimentos
          </a>
          <a href="/#contact" className={`inline-block leading-[96px] relative h-[96px] ml-8 ${path.includes('/#contact') && 'font-semibold text-primary after:content-[\'\'] after:absolute after:left-0 after:bottom-0 after:bg-primary after:w-full after:h-[3px] after:rounded-tl-[3px] after:rounded-tr-[3px] after:rounded-bl-none after:rounded-br-none'}`}>
            Contato
          </a>
          <Link to="/login" className={'inline-block leading-[96px] relative h-[96px] ml-8'}>
            Entrar
          </Link>
        </nav>
      </div>
    </header>
  );
}