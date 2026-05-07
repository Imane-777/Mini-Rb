import { Link } from 'react-router-dom';

export default function Logo({ size = 'h-8 w-8', center = false }) {
    return (
        <Link
            to="/"
            className={`flex ${center ? 'justify-center' : ''} items-center space-x-2 text-rose-500 hover:text-rose-600 transition`}
        >
            <img src="/images/logo.png" alt="Mini-Rb" className={`${size} object-contain`} />
            <span className="font-bold text-2xl tracking-tighter">Mini-Rb</span>
        </Link>
    );
}
