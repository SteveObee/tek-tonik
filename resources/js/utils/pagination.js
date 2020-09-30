export const paginateCollection = (collection, itemsPerPage, currentPage) => {
  const collectionLength = collection.length;
  const totalItemIndices = collectionLength - 1;
  const totalPages = Math.ceil(collectionLength / itemsPerPage);
  let prevPage;
  let nextPage;

  currentPage > 1 ? (prevPage = currentPage - 1) : (prevPage = null);
  currentPage < totalPages ? (nextPage = currentPage + 1) : (nextPage = null);

  const itemIndices = [];

  for (let i = 0; i <= totalItemIndices; i++) {
    itemIndices.push(i);
  }

  const indexOfLastItem = currentPage * itemsPerPage;
  const indexOfFirstItem = indexOfLastItem - itemsPerPage;

  const data = collection.slice(indexOfFirstItem, indexOfLastItem);

  return {
    currentPage,
    prevPage,
    nextPage,
    totalPages,
    data
  };
};
