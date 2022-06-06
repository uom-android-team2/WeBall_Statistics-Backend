export const loadData = async function (PATH) {
  try {
    const response = await fetch(PATH);
    const data = await response.json();
    if (!response.ok) {
      throw new Error(`Problem to load data (${response.status})`);
    }
    return data;
  } catch (err) {
    throw err;
  }
};
