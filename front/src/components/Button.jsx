export function Button({ children, onClick, disabled = false, outline, ...rest }) {
  return (
    <button
      className={`${outline ? 'bg-transparent border border-1 border-button text-button transition hover:bg-buttonOutline' : 'bg-button text-white font-semibold'} flex flex-row items-center justify-center gap-3 px-4 py-2 rounded-md hover:opacity-80`}
      onClick={onClick}
      disabled={disabled}
      {...rest}
    >
      {children}
    </button>
  );
}