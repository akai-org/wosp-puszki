export const SUPER_ADMIN = 'superadmin';

export const permissions = {
  superadmin: 1,
  collectorcoordinator: 2,
  admin: 3,
  volounteer: 4,
} as const;

export const boxTypeFormSelectOptions = [
  {
    value: 0,
    label: 'Puszka Wolontariusza',
  },
  {
    value: 10000,
    label: 'Puszka Stacjonarna',
  },
  {
    value: 20000,
    label: 'Puszka Firmowa',
  },
];
