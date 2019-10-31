let imagesToLoad = document.querySelectorAll('img[data-src]');

const imageLoad = (image) => {
    image.setAttribute('src', image.getAttribute('data-src'));
    image.onLoad = () => {
        image.removeAttribute('data-src');
    };
};

if('IntersectionObserver' in window) {
    const imageObserver = new IntersectionObserver((items, observer) => {
        items.forEach((item) => {
            if(item.isIntersecting){
                imageLoad(item.target);
                observer.unobserve(item.target);
            }
        });
    });
    imagesToLoad.forEach((img) => {
        imageObserver.observe(img);
    });
}
else {imagesToLoad.forEach((img) => {
    imageLoad(img)
});
}