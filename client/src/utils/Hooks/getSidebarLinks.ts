import {
  SETTLE_PROCESS_PATH,
  ADMIN_PATH,
  SUPER_ADMIN,
  COUNTED_BOXES_PATH,
} from '../Constants';

export const getSidebarLinks = (username: string | null) => {
  if (username === SUPER_ADMIN) {
    return [
      { label: 'Strona Główna', url: '' },
      { label: 'Przeliczone puszki', url: COUNTED_BOXES_PATH },
      { label: 'Administracja', url: ADMIN_PATH },
      { label: 'Puszki', url: SETTLE_PROCESS_PATH },
    ];
  }
  return [
    { label: 'Strona Główna', url: '' },
    { label: 'Puszki', url: SETTLE_PROCESS_PATH },
  ];
};
