import { DisplayableData, IUser } from '../types';

export const createUsersData = (data: IUser[]) => {
  const users = [];

  for (const item of data) {
    users.push({
      user_id: item.id,
      name: item.name,
      role: item.roles[0].description,
    });
  }

  return users as DisplayableData[];
};
