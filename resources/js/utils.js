export const uuid = (() => {
  let index = 0;

  return () => {
    index += 1;
    return index.toString();
  };
})();
