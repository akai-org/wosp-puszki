import { SETTLE_PROCESS_PATH } from '../Constants';
import { useBoxContext } from '../Contexts';
import { isBoxExists } from '../Functions';
import { useNavigate } from 'react-router-dom';

export const useGetBoxData = () => {
  const navigate = useNavigate();
  const { boxIdentifier, collectorName, collectorIdentifier, createBox, deleteBox } =
    useBoxContext();

  if (!isBoxExists(collectorName, collectorIdentifier, boxIdentifier)) {
    navigate(SETTLE_PROCESS_PATH);
  }

  return {
    boxIdentifier: boxIdentifier as NonNullable<typeof boxIdentifier>,
    collectorName: collectorName as NonNullable<typeof collectorName>,
    collectorIdentifier: collectorIdentifier as NonNullable<typeof collectorIdentifier>,
    createBox,
    deleteBox,
  };
};
