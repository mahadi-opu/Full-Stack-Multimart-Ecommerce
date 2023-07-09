import React, {useState} from 'react';
import Slider from "react-slick";
import styles from '../../../Assets/CSS/Slider/Slider.module.css';

import InstructorCard from '../Card/InstructorCard';


// import one from '../../Assets/images/Instructor/image 21.png'
import two from '../../../Assets/Images/instructor/instructor_maruf.png'
// import three from '../../Assets/images/Instructor/image 21.png'


const sliders = [InstructorCard, InstructorCard, InstructorCard, InstructorCard];

const CardSlider = ({SlideShape}) => {
  const [imageIndex, setImageIndex] = useState(0);

  const settings = {
    infinite: true,
    lazyLoad: true,
    dots: true,
    arrows: false,
    speed: 300,
    slidesToShow: 3,
    centerMode: true,
    centerPadding: 0,
    beforeChange: (current, next) => setImageIndex(next),
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
          infinite: true,
          dots: false
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          initialSlide: 2
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
    ]

  };

    return (
        <>
            <div className={styles.CategorySliderWrap}>
                <Slider {...settings}>
                  {sliders.map((slide, idx) => (
                    <div key={idx} className={idx === imageIndex ? "slide activeSlide" : "slide"}>
                        <InstructorCard
                          images={two}
                          name="Nazmul Huda"
                          title="Full-Stack Web Developer"
                          company="ThemeShaper"
                          fb="#"
                          linkedin="#"
                          youtube="#"
                          more_name="More Info"
                          more_link="#"
                        />
                    </div>
                  ))}
                </Slider>
            </div>
        </>
    );
};

export default CardSlider;