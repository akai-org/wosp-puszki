export const isBoxExists = (
  collectorName: string | null,
  collectorIdentifier: string | null,
  boxIdentifier: string | null,
) => {
  if (collectorName === null || collectorIdentifier === null || boxIdentifier === null)
    return false;
  return true;
};
