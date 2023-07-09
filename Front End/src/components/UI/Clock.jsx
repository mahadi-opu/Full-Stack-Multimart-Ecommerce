

import React, {useState, useEffect} from 'react'
import '../../styles/clock.css';


const Clock = () => {

    const [days, setDays] = useState()
    const [hours, setHours] = useState()
    const [minutes, setMinutes] = useState()
    const [seconds, setSeconds] = useState()

    let interval;

    const counDown = ()=> {
        const destination = new Date ('Oct 30, 2023').getTime()

        interval = setInterval (()=>{

            const now = new Date().getTime(interval.current)
            const different = destination - now 
            const days = Math.floor(different / (1000 * 60 * 60 *24))

            const hours = Math.floor(different % (1000 *60*60*24) / 
            (1000*60*60))
            const minutes = Math.floor(different % (1000 *60*60) /
            (1000*60))
            const seconds = Math.floor(different % (1000 *60) /
            1000)

            if(destination < 0) clearInterval()
            else{
                setDays(days)
                setHours(hours)
                setMinutes(minutes)
                setSeconds(seconds)
            }
        });
    };

    useEffect(()=>{
        counDown()
    })

  return (
    <>
        <div className='clock__wrapper d-flex align-items-center gap-3'>
         
            <div className='clock__data d-flex align-items-center gap-3'>
                <div>
                    <h1 className='text-white fs-3 mb-2'> {days} </h1>
                    <h5 className='text-white fs-6'> Days </h5>
                </div>
                <span className='text-white fs-3'> : </span>
            </div>
            <div className='clock__data d-flex align-items-center gap-3'>
                <div>
                    <h1 className='text-white fs-3 mb-2'> {hours}</h1>
                    <h5 className='text-white fs-6'> Hours</h5>
                </div>
                <span className='text-white fs-3'> : </span>
            </div>
            <div className='clock__data d-flex align-items-center gap-3'>
                <div>
                    <h1 className='text-white fs-3 mb-2'>{minutes}</h1>
                    <h5 className='text-white fs-6'> Minute </h5>
                </div>
                <span className='text-white fs-3'> : </span>
            </div>
            <div className='clock__data d-flex align-items-center gap-3'>
                <div>
                    <h1 className='text-white fs-3 mb-2'> {seconds }</h1>
                    <h5 className='text-white fs-6'> Second </h5>
                </div>
            </div>
        </div>
    </>
  )
}

export default Clock