export const SUPER_ADMIN = 'superadmin';

export const permissions = {
  superadmin: 1,
  admin: 2,
  collectorcoordinator: 3,
  volounteer: 4,
  movementcontroller: 5,
} as const;

export const boxTypeFormSelectOptions = [
  {
    value: 0,
    label: 'Puszka Wolontariusza (-)',
  },
  {
    value: 10000,
    label: 'Puszka Firmowa (PF)',
  },
];
