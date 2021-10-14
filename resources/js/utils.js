export const getUID = ((id = 0) => {
    let index = Number(id);
    return () => {
        index += 1;
        return index.toString();
    };
})();