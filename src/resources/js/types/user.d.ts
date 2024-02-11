// user.d.ts

interface Group {
    gid: number;
    name: string;
    created_at: string;
    updated_at: string;
}

/**
 * 用户对象接口
 */
type User = {
    uid: number;
    gid: number;
    status: number;
    /** 用户名 */
    username: string;
    /** 邮箱 */
    email: string;
    /** 积分 */
    point: number;
    /** 账号创建日期 */
    created_at: string;
    /** 账号登录日期 */
    updated_at: string;
    /** 用户组 */
    group: Group;
}
  