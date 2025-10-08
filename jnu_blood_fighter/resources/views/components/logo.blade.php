{{-- Logo Component --}}
<span class="logo-icon-container">
    <i class="bi bi-hand-index-thumb-fill logo-icon hand"></i>
    <i class="bi bi-heart-fill logo-icon heart"></i>
    <span class="logo-glow"></span>
</span>
<span class="logo-text">JnU LifeDr<span class="blood-drop">🩸</span>p</span>

<style>
    /* MODERN ANIMATED LOGO (Heart-in-Hand) - START */
    .logo-icon-container {
        position: relative;
        width: 1.8rem;
        height: 1.8rem;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        transition: transform 0.3s ease;
    }
    
    .logo-icon-container:hover {
        transform: scale(1.1);
    }
    
    /* Animated glow background */
    .logo-glow {
        position: absolute;
        width: 100%;
        height: 100%;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.3) 0%, transparent 70%);
        animation: pulse-glow 2s infinite ease-in-out;
        z-index: 0;
    }
    
    /* The Hand Icon (Background/Support) */
    .logo-icon.hand {
        font-size: 1.8rem;
        color: white;
        position: absolute;
        top: 0;
        left: 0;
        transform: rotate(-10deg);
        filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.3));
        z-index: 1;
    }

    /* The Heart Icon (Foreground/Life) */
    .logo-icon.heart {
        font-size: 1.1rem;
        color: var(--accent-red);
        position: absolute;
        top: 50%;
        left: 55%;
        transform: translate(-50%, -50%);
        z-index: 2;
        text-shadow: 0 0 5px rgba(255, 255, 255, 0.5);
        animation: heartbeat 1.5s ease-in-out infinite;
    }

    /* Logo hover effect */
    .logo-icon-container:hover .logo-icon.heart {
        animation: heartbeat-fast 0.6s ease-in-out infinite;
    }

    /* Subtle glow animation */
    @keyframes pulse-glow {
        0%, 100% { 
            box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.4);
            opacity: 0.6;
        }
        50% { 
            box-shadow: 0 0 0 10px rgba(255, 255, 255, 0);
            opacity: 1;
        }
    }

    /* Heartbeat animation */
    @keyframes heartbeat {
        0%, 100% { 
            transform: translate(-50%, -50%) scale(1);
        }
        14% { 
            transform: translate(-50%, -50%) scale(1.15);
        }
        28% { 
            transform: translate(-50%, -50%) scale(1);
        }
        42% { 
            transform: translate(-50%, -50%) scale(1.15);
        }
        56% { 
            transform: translate(-50%, -50%) scale(1);
        }
    }

    /* Fast heartbeat on hover */
    @keyframes heartbeat-fast {
        0%, 100% { 
            transform: translate(-50%, -50%) scale(1);
        }
        50% { 
            transform: translate(-50%, -50%) scale(1.2);
        }
    }

    /* Logo Text */
    .logo-text {
        font-weight: 700;
        font-size: 1.6rem;
        letter-spacing: -0.5px;
        margin-left: 0.5rem;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
    }
    
    .logo-text:hover {
        letter-spacing: 0px;
    }
    
    /* Blood Drop Emoji - Dark Red #780606 */
    .blood-drop {
        display: inline-block;
        font-size: 1.4rem;
        color: #780606;
        animation: drop-fall 3s ease-in-out infinite, drop-pulse 2s ease-in-out infinite;
        transform-origin: center top;
        filter: drop-shadow(0 2px 6px rgba(120, 6, 6, 0.5));
    }
    
    .logo-text:hover .blood-drop {
        animation: drop-fall-fast 1.5s ease-in-out infinite, drop-pulse-fast 0.8s ease-in-out infinite;
        filter: drop-shadow(0 3px 10px rgba(120, 6, 6, 0.8));
    }
    
    @keyframes drop-fall {
        0%, 100% { 
            transform: translateY(0) scale(1);
        }
        50% { 
            transform: translateY(3px) scale(0.98);
        }
    }
    
    @keyframes drop-fall-fast {
        0%, 100% { 
            transform: translateY(0) scale(1);
        }
        50% { 
            transform: translateY(5px) scale(0.95);
        }
    }
    
    @keyframes drop-pulse {
        0%, 100% { 
            filter: drop-shadow(0 2px 6px rgba(120, 6, 6, 0.5)) brightness(1);
        }
        50% { 
            filter: drop-shadow(0 3px 10px rgba(120, 6, 6, 0.8)) brightness(1.2);
        }
    }
    
    @keyframes drop-pulse-fast {
        0%, 100% { 
            filter: drop-shadow(0 3px 10px rgba(120, 6, 6, 0.8)) brightness(1);
        }
        50% { 
            filter: drop-shadow(0 4px 15px rgba(120, 6, 6, 1)) brightness(1.3);
        }
    }
    
    /* Responsive design */
    @media (max-width: 768px) {
        .logo-icon-container {
            width: 1.5rem;
            height: 1.5rem;
        }
        
        .logo-icon.hand {
            font-size: 1.5rem;
        }
        
        .logo-icon.heart {
            font-size: 0.9rem;
        }
        
        .logo-text {
            font-size: 1.3rem;
        }
        
        .blood-drop {
            font-size: 1.2rem;
        }
    }
    /* MODERN ANIMATED LOGO - END */
</style>