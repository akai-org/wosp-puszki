export const LOGIN_ROUTE = 'login';
export const MAIN_ROUTE = 'liczymy';
export const NOT_FOUND_ROUTE = '*';

// Counted boxes section
// main
export const COUNTED_BOXES_ROUTE = 'countedBoxes';
// subroutes
export const APPROVED_BOXES_PAGE_ROUTE = 'approved';

// Boxes section
// main
export const BOXES_ROUTE = 'boxes';
export const SETTLE_PROCESS_ROUTE = 'settle';
// subroutes
export const BOXES_LIST_PAGE_ROUTE = 'listBoxes';
export const UNSETTLED_BOXES_LIST_PAGE_ROUTE = 'unsettled';
// settle process paths
export const FIND_BOX_PAGE_ROUTE = 'find';
export const FIND_BOX_BUSY_PAGE_ROUTE = 'find/busy';
export const ACCEPT_BOX_PAGE_ROUTE = 'accept';
export const DEPOSIT_BOX_PAGE_ROUTE = 'deposit';
export const CHECKOUT_BOX_PAGE_ROUTE = 'checkout';

// Admin section
// main
export const ADMIN_ROUTE = 'admin';
// subroutes
export const ADD_USER_PAGE_ROUTE = 'users/add';
export const VOLUNTEERS_LIST_PAGE_ROUTE = 'volunteers/list';
export const ADD_VOLUNTEER_PAGE_ROUTE = 'volunteers/add';
export const LOGS_PAGE_ROUTE = 'logs';

// long paths for navigate
export const BOXES_PATH = `/${MAIN_ROUTE}/${BOXES_ROUTE}`;
export const SETTLE_PROCESS_PATH = `${BOXES_PATH}/${SETTLE_PROCESS_ROUTE}`;
export const ADMIN_PATH = `/${MAIN_ROUTE}/${ADMIN_ROUTE}`;
export const LOGIN_PATH = `/${MAIN_ROUTE}/${LOGIN_ROUTE}`;
export const COUNTED_BOXES_PATH = `/${MAIN_ROUTE}/${COUNTED_BOXES_ROUTE}`;
export const All_BOXES_PATH = `/${MAIN_ROUTE}/${BOXES_ROUTE}/${BOXES_LIST_PAGE_ROUTE}`;
export const UNSETTLED_BOXES_PATH = `/${MAIN_ROUTE}/${BOXES_ROUTE}/${UNSETTLED_BOXES_LIST_PAGE_ROUTE}`;

// Sidebar links names

export const ADMIN_ROUTE_NAME = 'Admin';
export const BOXES_ROUTE_NAME = 'Puszki';
export const MAIN_ROUTE_NAME = 'Strona Główna';
export const COUNTED_BOXES_ROUTE_NAME = 'Przeliczone puszki';
