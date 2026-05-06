import { useState } from 'react';

export default function Gallery({ images, alt }) {
    const [active, setActive] = useState(0);

    if (!images || images.length === 0) {
        return (
            <div className="rounded-2xl overflow-hidden mb-10 h-[500px] bg-gray-200 flex items-center justify-center">
                <span className="text-gray-400 text-xl">Pas d'image</span>
            </div>
        );
    }

    const prev = () => setActive((i) => (i - 1 + images.length) % images.length);
    const next = () => setActive((i) => (i + 1) % images.length);

    return (
        <div className="mb-10">
            <div className="relative rounded-2xl overflow-hidden h-[500px] bg-gray-100">
                <img
                    src={images[active].url}
                    alt={alt}
                    className="w-full h-full object-cover"
                />

                {images.length > 1 && (
                    <>
                        <button
                            type="button"
                            onClick={prev}
                            className="absolute left-4 top-1/2 -translate-y-1/2 bg-white/90 hover:bg-white w-10 h-10 rounded-full shadow-lg flex items-center justify-center transition"
                            aria-label="Image précédente"
                        >
                            <svg className="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>
                        <button
                            type="button"
                            onClick={next}
                            className="absolute right-4 top-1/2 -translate-y-1/2 bg-white/90 hover:bg-white w-10 h-10 rounded-full shadow-lg flex items-center justify-center transition"
                            aria-label="Image suivante"
                        >
                            <svg className="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                        <div className="absolute bottom-4 right-4 bg-black/60 text-white text-sm px-3 py-1 rounded-full">
                            {active + 1} / {images.length}
                        </div>
                    </>
                )}
            </div>

            {images.length > 1 && (
                <div className="flex gap-2 mt-3 overflow-x-auto pb-2">
                    {images.map((img, idx) => (
                        <button
                            key={img.id}
                            type="button"
                            onClick={() => setActive(idx)}
                            className={`flex-shrink-0 w-20 h-20 rounded-lg overflow-hidden border-2 transition ${
                                idx === active ? 'border-rose-500' : 'border-transparent opacity-70 hover:opacity-100'
                            }`}
                        >
                            <img src={img.url} alt="" className="w-full h-full object-cover" />
                        </button>
                    ))}
                </div>
            )}
        </div>
    );
}
