import logoWhite from '../assets/large-logo-white.png';
import image from '../assets/image.png';
import avatar from '../assets/avatar-testimony.png';
import { Quote, Instagram, Facebook, Youtube } from 'lucide-react';
import { LPHeader } from '../components/LandingPage/LPHeader';

export function Home() {
  return (
    <>
      <LPHeader />
      <section id="home">
        <div className="max-w-[1120px] py-32 mx-auto">
          <div className="px-4 lg:px-0 flex flex-col md:flex-row items-center justify-between gap-16">

            <div className="w-full flex flex-col gap-3">
              <h3 className="text-center lg:text-left text-title font-bold text-[32px]">
              A plataforma All-in-one para nutricionistas exigentes
              </h3>
              <p className="text-center lg:text-left text-text">
              A plataforma completa para agilizar
              sua prática nutricional, oferecer
              atendimento personalizado e expandir seus negócios
              </p>
            </div>
            <div className="max-w-[561px] w-full">
              <img src={image} alt="Imagem" />
            </div>
          </div>
        </div>
      </section>

      <section id="about" className="bg-white">
        <div className="max-w-[1120px] py-32 mx-auto relative">
          <div className="flex flex-col md:flex-row items-center justify-between gap-8 md:gap-16">
            <div className="max-w-[561px] w-full">
              <img src={image} alt="Imagem" className="md:absolute md:max-w-[561px] md:left-[-210px] md:top-0 md:my-32" />
            </div>
            <div className="px-4 md:px-0 w-full flex flex-col gap-3">
              <h3 className="text-title font-bold text-[32px]">
                Sobre
              </h3>
              <p className="text-text">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse sagittis arcu quis nisi luctus, id accumsan felis tristique. Proin quis bibendum diam. Sed consequat nisl laoreet eros ultricies pellentesque. Nullam in est porta, pellentesque massa vitae, vehicula risus.
                <br />
                <br />
                In placerat, felis vitae sodales dictum, lacus quam pretium mi, ut pretium urna turpis eu dui. Vestibulum id ullamcorper nibh. Donec luctus, nunc finibus elementum suscipit, tortor augue vulputate sapien, vitae feugiat enim augue sed.
                <br />
                <br />
                Quisque id aliquam elit. Suspendisse congue pharetra maximus. Duis rutrum velit a leo euismod dictum. Sed sodales est efficitur arcu tincidunt tincidunt. Curabitur fringilla, risus at feugiat feugiat, nisl nulla tincidunt tellus, elementum elementum lorem nisl eleifend dolor. Nullam eget dui at sem ullamcorper luctus.
              </p>
            </div>
          </div>
        </div>
      </section>

      <section id="pricing" className="bg-white">
        <div className="max-w-[1120px] py-32 mx-auto relative">

        </div>
      </section>
      <section id="testimonies" className="bg-white">
        <div className="px-4 lg:px-0 max-w-[1120px] py-32 mx-auto">
          <h3 className="text-title font-bold text-[32px] text-center">
            Depoimentos de nossos usuários
          </h3>

          <div className="my-8 flex flex-col md:flex-row items-center justify-between gap-8">
            <div className="absolute size-32 bg-primary rounded-full transition hover:w-full"></div>
            <div className="bg-white/20 backdrop-blur-3xl shadow-lg border border-box rounded-2xl p-11 flex flex-col gap-8">
              <Quote className="text-secondary" />
              <p className="text-title">
              Eu sou cliente da Fluxora há 5 anos e não troco por nada!
              Certamente minha produtividade como nutricionista mudou. Não tenho dúvidas.
              </p>
              <div className="flex flex-row items-center gap-4">
                <img src={avatar} alt="Avatar" className="size-8" />
                <p className="text-title">Cíntia Barbosa</p>
              </div>
            </div>

            <div className="bg-white border border-box rounded-2xl p-11 flex flex-col gap-8">
              <Quote className="text-secondary" />
              <p className="text-title">
              Eu sou cliente da Fluxora há 5 anos e não troco por nada!
              Certamente minha produtividade como nutricionista mudou. Não tenho dúvidas.
              </p>
              <div className="flex flex-row items-center gap-4">
                <img src={avatar} alt="Avatar" className="size-8" />
                <p className="text-title">Mariana Dias</p>
              </div>
            </div>
          </div>
        </div>
      </section>

      <footer className="bg-primary text-white">
        <div className="max-w-[1120px] py-16 mx-auto">
          <div className="px-4 lg:px-0 flex flex-col md:flex-row md:items-end justify-between">
            <div>
              <img src={logoWhite} alt="Logo" className="w-[125px]" />
              <p className="mt-16">
                © 2024 Fluxora. <br />
                Todos os direitos reservados.
              </p>
            </div>
            <div className="flex flex-row gap-4">
              <a href="">
                <Instagram />
              </a>
              <a href="">
                <Facebook />
              </a>
              <a href="">
                <Youtube />
              </a>
            </div>
          </div>
        </div>
      </footer>
    </>
  );
}