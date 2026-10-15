import { Link } from 'react-router-dom';

export function Anchor({ children, to }) {
  return (
    <Link to={to} className="font-semibold text-link hover:underline">{children}</Link>
  );
}