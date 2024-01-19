import { DisplayableData, IUser } from '../types';

export const createUsersData = (data: IUser[]) => {
  const users = [];

  for (const item of data) {
    users.push({
      user_id: item.name,
      name: item.roles[0].name,
      role: item.roles[0].description,
    });
  }

  return users as DisplayableData[];
};
