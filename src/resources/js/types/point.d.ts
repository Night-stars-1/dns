interface PointItem {
    id: number,
    uid: number,
    /** 操作 */
    action: string,
    /** 积分 */
    point: number,
    /** 剩余积分 */
    rest: number,
    /** 备注 */
    remark: string,
    /** 创建时间 */
    created_at: string,
}
  
type PointList = PointItem[];