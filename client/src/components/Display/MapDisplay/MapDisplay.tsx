import { MapController } from '@components/Layout/MapController/MapController';
import { volunteerStatusClass } from '@/utils';
import { FC } from 'react';

interface Props {
  stations: Record<number, volunteerStatusClass>;
}

export const MapDisplay: FC<Props> = ({ stations }) => {
  return (
    <section>
      <MapController stations={stations} />
    </section>
  );
};
