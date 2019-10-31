let imagesToLoad = document.querySelectorAll('img[data-src]');

const options = {
    threshold: 0,
    rootMargin: "0px 0px 350px 0px"
};

const imageLoad = (image) => {
    image.setAttribute('src', image.getAttribute('data-src'));
    image.onLoad = () => {
        image.removeAttribute('data-src');
    };
};

if('IntersectionObserver' in window) {
    const imageObserver = new IntersectionObserver((items,observer) => {
        items.forEach((item) => {
            if(item.isIntersecting){
                imageLoad(item.target);
                observer.unobserve(item.target);
            }
        });
    }, options);
    imagesToLoad.forEach((img) => {
        imageObserver.observe(img);
    });
}
else {imagesToLoad.forEach((img) => {
    imageLoad(img)
});
}