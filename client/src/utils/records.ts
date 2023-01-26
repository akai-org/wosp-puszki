import { volunteerStatus, volunteerStatusClass } from '@utils/types';

export const volunteerStatuses: Record<volunteerStatus, volunteerStatusClass> = {
  available: 'volunteer-available',
  occupied: 'volunteer-occupied',
  unavailable: 'volunteer-unavailable',
};
