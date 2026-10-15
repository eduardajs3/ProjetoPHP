import logo from '../../public/large-logo.png';

export function RegisterLayout({ children, title, subtitle }) {
  return (
    <div className="grid grid-cols-2">
      <div className="h-screen">
        <img src={logo} className="max-w-[126px] m-4" />
      </div>
      <div className="flex flex-col items-end h-screen ">
        <div className="m-4 max-w-[560px] w-full h-screen flex flex-col justify-center bg-white p-20 rounded-[32px]">
          <div className="flex flex-col gap-3">
            <h3 className="text-2xl font-bold text-title">{title}</h3>
            <p className="text-text text-sm">{subtitle}</p>
          </div>

          {children}
        </div>
      </div>
    </div>
  );
}